    function ckname(){
        var x=document.getElementById("saccount").value;
        var y=document.getElementById("domename");
        var Regx=/^[A-Za-z0-9]*$/;

        if(x==""){
            y.innerHTML="账号不能为空！";
            return 0;
        }
        else if(x.length>10){
            y.innerHTML="账号最大长度为10";
            return 0;
        }
        else if(!Regx.test(x)){
            y.innerHTML="账号只能包含字母和数字";
            return 0;
        }
        else{
            y.innerHTML="";
            return 1;
        }
    }
    function ckpass() {
        var x=document.getElementById("spassword").value;
        var y=document.getElementById("domepass");
        var pattern=new RegExp("[`~!@#$^&*()=|{}':;',\\[\\]<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");

        if(x==""){
            y.innerHTML="密码不能为空！";
            return 0;
        }
        else if(x.length>10){
            y.innerHTML="密码最大长度为10";
            return 0;
        }
        else if(pattern.test(x)){
            y.innerHTML="包含非法字符";
            return 0;
        }
        else{
            y.innerHTML="";
            return 1;
        }
    }
    // function aa() {
    //     var bt=document.getElementById("btn");
    //     var x=ckname();
    //     var y=ckpass();
    //     if(x==1&&y==1){
    //         bt.disabled=false;
    //     }
    // }
    function checklogin(){
        var name=document.getElementById("saccount").value;
        var name_y=document.getElementById("domename");
        var pass=document.getElementById("spassword").value;
        var pass_y=document.getElementById("domepass");
        var subbtn=document.getElementById("btn");

        if(name==""){
            name_y.innerHTML="么有输入账号啊！！！";
            return false;
        }
        if(pass==""){
            pass_y.innerHTML="么有输入密码啊！！！";
            return false;
        }
        if(!empty(name)&&!empty(pass)){
            subbtn.onclick=formsub();
        }
    }
    function formsub(){
        var formsub=document.forms["form1"];
        formsub.submit();
    }