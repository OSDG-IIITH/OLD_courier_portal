<html>
<head>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		$("button").click(function(){
			    $.post("2.php",  {
q:1
}  , function(result){
      $("div").html(result);
    });
			});
		});
</script>
</head>
<body>

<div><h2>Let AJAX change this text</h2></div>
<button>Change Content</button>
</body>
</html>

