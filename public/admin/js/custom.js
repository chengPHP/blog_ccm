/**
 * Created by CCM on 2018/6/25.
 */
var blog = function(){
    return {
        aaa: function () {
            alert("aaaa");
        },
        errorPrompt : function (jqXHR, textStatus, errorThrown) {
            if(jqXHR.status == 422){
                var arr = "";
                for (var i in jqXHR.responseJSON) {
                    if (i == 'message') {
                        continue;
                    }
                    var xarr = jqXHR.responseJSON[i];
                    for (var s in xarr) {
                        for (var j=0;j<xarr[s].length;j++){
                            var str = xarr[s][j];
                            arr += str+",";
                        }
                    }
                }
                swal("",arr.substring(0,arr.length-1), "error");
            }
        }
    }

}();