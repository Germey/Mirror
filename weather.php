<?php 

	class Weather {

		public function getHeaders() {
			$headers['Host'] = 'wthrcdn.etouch.cn';
			$headers['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36';
			$headerArr = array(); 
			foreach($headers as $n => $v) { 
			    $headerArr[] = $n .':' . $v;  
			}
			return $headerArr;
		}

		public function getResponse($cityKey = '101120101') {
			$headers = $this->getHeaders();
			$ch = curl_init();
			$url = 'http://wthrcdn.etouch.cn/WeatherApi?citykey=' . $cityKey;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_ENCODING ,'gzip');
			$out = curl_exec($ch);
			curl_close ($ch);
			$result =  (array)simplexml_load_string($out);
			$array['city'] = $result['city'];
			$array['wendu'] = $result['wendu'];
			$array['shidu'] = $result['shidu'];
			$environment = (array)$result['environment'];
			$array['kongqi'] = $environment['quality'];
			$array['suggest'] = $environment['suggest'];
			return $array;

		}

	}
