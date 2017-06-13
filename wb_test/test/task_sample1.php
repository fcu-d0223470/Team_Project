<!DOCTYPE html>
<html>
    <head>
        <title>輸入地址批次轉換經緯度小工具</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script>
            var i;
            var split;

            function trans() {
                i = 0;
                $("#target").val("");
                var content = $("#source").val();
                split = content.split("\n");
                delayedLoop();
            }

            function delayedLoop() {
                addressToLatLng(split[i]);
                if (++i == split.length) {
                    return;
                }
                window.setTimeout(delayedLoop, 1500);
            }

            function addressToLatLng(addr) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    "address": addr
                }, function (results, status) {
					if ($("#c").attr('checked'))
					{
						addr = addr + "=";
					}
					else {
						addr = "";
					}
                    if (status == google.maps.GeocoderStatus.OK) {
                        var content = $("#target").val();
                        $("#target").val(content + addr + results[0].geometry.location.lat() + "," + results[0].geometry.location.lng() + "\n");
                    } else {
                        var content = $("#target").val();
                        $("#target").val(content + addr + "查無經緯度" + "\n");
                    }
                });
            }
        </script>
    </head>
    
    <body>
		<p>1. 請輸入地址，一行輸入一個地址</p>
		<p>
			<textarea rows="9" name="S1" cols="67" id="source">台北市信義區市府路1號</textarea>
		</p>
		<p>2. 請選擇輸出要不要加入地址? <input type="checkbox" id="c" name="c" value="ON">加上</p>
		<p>
			3. 點選 <input type="button" value="開始轉換" name="B1" onclick="trans();">
		</p>
		<p>4. 地址轉換經緯度結果如下 (格式：Latitude,Longitude)</p>
		<p>
			<textarea rows="9" name="S2" cols="67" id="target"></textarea>
		</p>
		<p>
			本工具由 <a href="http://uhooamber.com/">李小淮</a> 開發與維護，如有使用上問題與意見反應或批評指教，請聯繫 uhoolee@hotmail.com，謝謝。
		</p>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-1478416-8']);
		  _gaq.push(['_setDomainName', 'uhooamber.com']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	</body>
</html>