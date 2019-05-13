var domain = "192.168.30.10";

async function getUserId(){
	var jwt = getCookie("jwt");
    var id = await $.post("http://192.168.33.10/api/user/vailadate_user.php", JSON.stringify({jwt:jwt})).done(function(result) {
    	return result.data.id;
    });
    return id.data.id;
};

function getCookie(name) {
  var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
  if (match) return match[2];
}