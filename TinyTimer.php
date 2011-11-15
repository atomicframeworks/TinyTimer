<?php	
	class TinyTimer {	
		private $timeStart;
		private $timeStop;
		private $runningTime;
		private $precise = 5;
		public function __construct($running = true) {
			if($running === true){
				$this->start();
			}
		return $this;
		}
       	public function __toString(){
			$time = (string) number_format($this->getTime(),$this->precise);
			return $time;
		}
		public function getTime(){
			$this->__calcTime();
			$totalTime = $this->runningTime;
			return $totalTime;
		}
		public function start(){
			if (empty($this->timeStart)){
				$this->timeStart = microtime(true);
			}
			return $this;
		}
		public function stop(){
			if (!empty($this->timeStart)){
				$this->timeStop = microtime(true);
				$this->__calcTime();
			}
			return $this;
		}
		public function clear(){
			$this->timeStart = 0.0;
			$this->timeStop = 0.0;
			$this->runningTime = 0.0;
			return $this;
		}
		public function restart(){
			$this->timeStart = microtime(true);
			$this->timeStop = 0.0;
			$this->runningTime = 0.0;
			return $this;
		}
		public function trunk($name, $running = false){
			if(empty($this->$name)){
				$this->$name = new TinyTimer($running);
			}
			return $this->$name;
		}
		public function branch($name, $running = false){
			if(empty($this->$name)){
				$this->$name = new TinyTimer($running);
			}
			return $this;
		}
		public function precision($num = 4){
			$this->precise = (int)$num;
		}
		private function __calcTime(){
			if (!empty ($this->timeStart)){
				if (!empty ($this->timeStop)){
					$this->runningTime += ($this->timeStop - $this->timeStart);
					$this->timeStart = 0.0;
					$this->timeStop = 0.0;
				}
				else {
					$this->runningTime += (microtime(true) - $this->timeStart);
					$this->timeStart = microtime(true);
				}		
			}
			return $this->runningTime;
		}
	}
?>