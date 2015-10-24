<?php 
	include "simple_html_dom.php" ;

	class News {

		public function getHeaders() {
			$headers['Host'] = 'news.baidu.com';
			$headers['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36';
			$headerArr = array(); 
			foreach($headers as $n => $v) { 
			    $headerArr[] = $n .':' . $v;  
			}
			return $headerArr;
		}

		public function getResponse() {
			$headers = $this->getHeaders();
			$ch = curl_init();
			$url = 'http://news.baidu.com/';
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$out = curl_exec($ch);
			curl_close ($ch);
			return $out;

		}

		public function parseHTML() {
			$content = $this->getResponse();
			$html = new simple_html_dom();
			$html->load($content);
			$result = $html->find("#pane-news .hotnews strong a");
			$array = array();
			foreach($result as $v) {
				array_push($array, iconv('GB2312', 'UTF-8', $v->innertext));
			}
			$arr = array();
			$i = 0;
			for ($i = 0; $i < 3; $i ++) {
				if ($array[$i]) {
					$arr[$i] = $array[$i];
				} else {
					$arr[$i] = "今日有爆炸性新闻";
				}
				
			}
			return $arr;
			
		}

	}
