/**
 * Created by CCM on 2018/8/10.
 */
var blog = function(){
    return {
        loading: function (message) {
            $('body').loading({
                loadingWidth:240,
                title:'',
                name:'loading',
                discription:message,
                direction:'column',
                type:'origin',
                // originBg:'#71EA71',
                originDivWidth:40,
                originDivHeight:40,
                originWidth:6,
                originHeight:6,
                smallLoading:false,
                loadingMaskBg:'rgba(0,0,0,0.2)'
            });
        },
        errorPrompt: function(jqXHR, textStatus, errorThrown){
            if(jqXHR.status == 422) {
                var arr = "";
                for (var i in jqXHR.responseJSON) {
                    if (i == "errors") {
                        var xarr = jqXHR.responseJSON[i];
                        for (var j in xarr) {
                            var str = xarr[j];
                            for (k = 0; k < str.length; k++) {
                                arr += str[k] + ",";
                            }
                        }
                    }
                }
                swal("", arr.substring(0, arr.length - 1), "error");
            }
        }
    }
}();