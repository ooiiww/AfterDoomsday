<script type="text/javascript">
var uiOpts = {
url : "http://graph.renren.com/oauth/authorize",
	  display : "iframe",
	  params : {"response_type":"token","client_id":"177400"},
	  onSuccess: function(r){
		  top.location = "http://apps.renren.com/afterdoomsday";
	  },
onFailure: function(r){} 
};
Renren.ui(uiOpts);
</script>
<h1>OAuth</h1>
