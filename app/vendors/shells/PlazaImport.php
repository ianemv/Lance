<?php

App::import('Core', 'File');
    
class PlazaImportShell extends Shell {

    var $uses = array('School', 'Plaza', 'PlazaImage');

    var $currentFileName;

    var $verbose = false;
	
	var $success = 0;

    var $errors = 0;
	
	var $failedFiles = '';
	
	var $version = '1.0';
	
    function startup() {
		
		$this->_hasFlags();

		if (!empty($this->params['dirName'])) {
			$this->dirName = $this->params['dirName'];
		} elseif (!empty($this->args[0])) {
			$this->dirName = $this->params['dirName'] = $this->args[0];
		}

	}
	
	private function _hasFlags() {
		foreach ($this->params as $name=>$value) {
			$name = strtolower($name);
			if ($name == 'verbose' || $name == 'v') {
				$this->verbose = true;
			} elseif ($name == 'datapath') {
				$this->useDataPath = true;
			} elseif ($name == 'help' || $name == '?') {
				$this->help();
			} elseif ($name == 'version') {
				$this->out(sprintf(__('Version %s', true), $this->version));
			}
		}	
	}
	
	private function _fileOrPathFilter($dirName) {
		$fileList = array();
		if ($fh = opendir($dirName)) {
			while(false != ($fileName = readdir($fh))) {
				$ext = substr(basename($fileName), strrpos(basename($fileName), '.') + 1);
				if ($ext == 'csv') {
					$fileList[] = $fileName;
				}
			}
		}
		closedir($fh);
		return $fileList;
	}
	
	private function _removeExtension($fileName) {
		$ext = substr(basename($fileName), strrpos(basename($fileName), '.'));
		if ($ext == '.csv') {
			return substr(basename($fileName), 0, -strlen($ext));
		}
        return null;
	}
	
	private function _processFile() {
		$this->out(sprintf(__('Creating Plazas with %s', true), basename($this->currentFileName)));
		$name = $this->_removeExtension($this->currentFileName);
        $i = 0;
        $buffer = array();
        if (file_exists($this->currentFileName)) {
            $file = new File($this->currentFileName);
            if ($file->open('r', true)) {
                while (($data = @fgetcsv($file->handle, 1000, ',','"')) !== false) {
                    if ($i != 0) {
                        $buffer[] = $data;
                    }
                    $i++;
                }
                $file->close();
            }
        }
        return $buffer;
    }

    private function _importPlazas($values) {
        foreach($values as $data) {
            $count = count($data);
            if ($this->verbose) {
                $this->out(sprintf(__('Currently Processing: %s', true), $data[1]));
            }
            $school['School'] = array('key' => $data[0], 'name' => $data[1], 'location' => $data[2], 'description' => $data[3], 'image' => $data['4']);
            $this->School->create();
            if ($school = $this->School->save($school)) {
                if ($this->verbose) {
                    $this->out(sprintf(__('Added school "%s" successfully', true), $data[1]));
                    $this->out(sprintf(__('Processing plaza for school "%s"', true), $data[1]));
                }
                if (!empty($school)) {
                    $plaza['Plaza'] = array('school_id' => $this->School->id, 'description' => $data[5]);
                    if ($count>5) {
                        if ($this->verbose) {
                            $this->out(sprintf(__('Found Image(s) for "%s"', true), $data[1]));
                        }
                        $plaza['PlazaImage'] = array();
                        $dirname = dirname($this->currentFileName);
                        if (is_dir($dirname.DS.$data[0])) {
                            for($i=6;$i<$count;$i++) {
                                if ($this->verbose) {
                                    $this->out(sprintf(__('Preparing image "%s" for school "%s"', true), $data[$i], $data[1]));
                                }
                                if (is_file($dirname.DS.$data[0].DS.$data[$i])) {
                                    $image = new File($dirname.DS.$data[0].DS.$data[$i]);
                                    $info = $image->info();
                                    $plaza['PlazaImage'][] = array(
                                        'plaza_id' => $this->Plaza->id,
                                        'image' => array(
                                            'name' => $data[$i],
                                            'type' => 'image'.DS.$info['extension'],
                                            'tmp_name' => $dirname.DS.$data[0].DS.$data[$i],
                                            'error' => 0,
                                            'size' => $image->size()
                                        )
                                    );
                                }
                            }
                        }
                    }
                    $this->Plaza->create();
                    if ($this->verbose) {
                        $image_count = (!empty($plaza['PlazaImage']))?count($plaza['PlazaImage']):0;
                        $this->out(sprintf(__('Adding Plaza for school "%s" with %d image(s)', true), $data[1], $image_count));
                    }
                    if ($this->Plaza->saveAll($plaza)) {
                        if ($this->verbose) {
                            $this->out(sprintf(__('Successfully Added Plaza for "%s"', true), $data[1]));
                            $this->hr();
                        }
                        $this->success++;
                    } else {
                        if ($this->verbose) {
                            $this->out(sprintf(__('Failed to add Plaza for school "%s"', true), $data[1]));
                        }
                        $this->failedFiles[$data[1]] = $this->Plaza->invalidFields();
                        $this->errors++;
                    }
                    
                }
            } else {
                if ($this->verbose) {
                    $this->out(sprintf(__('Failed to add School "%s"', true), $data[1]));
                }
                $this->failedFiles[$data[1]] = $this->School->invalidFields();
                $this->errors++;
            }
        }
    }

	private function _finalProcess($fileName, $results) {   
		$file = new File($fileName); 
		if ($file->delete()) {
			if ($this->verbose) {
		   		$this->out(sprintf(__('File "%s" was removed', true), basename($fileName)));
		   	} 
		} else {
			$this->out(sprintf(__('Unable to delete file: %s', true), basename($fileName)));
		}    
		$xmlResponse = new Xml($results);
		
		
	}
	
	function main() {
		$this->out(__('Plaza Import', true));
		$this->hr();
		$this->out(__('[I]mport plaza file(s)', true));
		$this->out(__('[H]elp', true));
		$this->out(__('[Q]uit', true));

		$choice = strtolower($this->in(__('What would you like to do?', true), array('I', 'H', 'Q')));
		switch ($choice) {
			case 'i':
				$this->import();
			break;
			case 'h':
				$this->help();
			break;
			case 'q':
				exit(0);
			break;
			default:
				$this->out(__('You have made an invalid selection. Please choose a command to execute by entering E, I, H, or Q.', true));
		}
		$this->hr();
		$this->main();
	}
	
	function import() {
		if (empty($this->args)) {
			$this->_interactive();
		}
		$this->_import();
	}
	
	private function _import() {
		
		if (isset($this->dirName)) {
			$dirName = realPath($this->dirName);
			if (is_file($dirName)) {
				if ($this->useDataPath) {
					$this->out(__('Second argument is a file.', true));
					$this->out(__('DataPath mode requires that to be a directory.', true));
					$this->_stop();
				}
				if ($this->verbose) {
					$this->out(__('Target file found.', true));
				}
				
				$this->currentFileName = $dirName;
				$output = $this->_processFile();
				if ($output != null) {
					if (!$this->_importPlazas($output)) {
						$this->errors++;
						$this->failedFiles[basename($dirName)] = array('file' => __('File could not be imported', true));
					}
				} else {
					$this->errors++;
				}
				
			} elseif (is_dir($dirName)) {
				if ($this->verbose) {
					$this->out(sprintf(__('Found Target Directory: %s', true), $dirName));
				}

				$fileList = $this->_fileOrPathFilter($dirName);
				
				if (empty($fileList)) {
					$this->out('No .csv files found in directory.', true);
					$this->_stop();
				} else {
					if (substr($dirName, -1) != '/'){
						$dirName = $dirName.'/';
					}
					for($i=0;$i<count($fileList);$i++) {
						$this->currentFileName = $dirName.$fileList[$i];
						$output = $this->_processFile();
						if ($output != null) {
							if (!$this->_importPlazas($output)) {
								continue;
							}
						} else {
							$this->errors++;
						}
					}
				}
			} else {
				$this->out(__('Second arg must be a file or directory to package', true));
				$this->_stop();
			}
		} else {
			$this->out(__('Please supply a valid Directory', true));
			$this->_stop();
		}
		
		$this->out(__('Finished!'), true);
        $this->hr();
		$this->out(sprintf(__('Successful plazas created: %d', true), $this->success));
		$this->out(sprintf(__('Unsuccessful plazas attempts: %d', true), $this->errors));
		if ($this->errors > 0) {
			$this->out(__("Here are the plazas that failed to import:", true));
            $this->hr();
            foreach ($this->failedFiles as $name => $errors) {
                $this->out(sprintf(__('Error: %s', true), $name));
                if (!empty($errors)) {
                    foreach ($errors as $key => $value) {
                        $this->out(sprintf(__('Field: (%s) - %s', true), $key, $value));
                    }
                    $this->hr();
                }
            }
            $this->hr();
		}
        $this->_stop();
		
	}
	
	
	private function _interactive() {
		$this->out("Plaza Import", true);
		$this->hr();
		$this->interactive = true;
	}
	
	function help() {
		
	}
	
}
