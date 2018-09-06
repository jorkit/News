    function ckname(){
        var x=document.getElementById("username").value;
        var y=document.getElementById("domename");
        var Regx=/^[A-Za-z0-9]*$/;

        if(x==""){
            y.innerHTML="账号不能为空！";
        }
        else if(x.length>10){
            y.innerHTML="账号最大长度为10";
        }
        else if(!Regx.test(x)){
            y.innerHTML="账号只能包含字母和数字";
        }
        else{
            y.innerHTML="";
        }
    }
    function ckpass() {
        var x=document.getElementById("password").value;
        var y=document.getElementById("domepass");
        var pattern=new RegExp("[`~!@#$^&*()=|{}':;',\\[\\]<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]")

        if(x==""){
            y.innerHTML="密码不能为空！";
        }
        else if(x.length>15){
            y.innerHTML="密码最大长度为15";
        }
        else if(pattern.test(x)){
            y.innerHTML="包含非法字符";
        }
        else{
            y.innerHTML="";
        }
    }
    function ckpassagain(){
        var x=document.getElementById("password").value;
        var y=document.getElementById("password2").value;
        var z=document.getElementById("domepass2");
        if(y==""){
            z.innerHTML="确认密码不能为空！";
            return false;
        }
        else if(x!=y){
            z.innerHTML="两次输入密码不一致";
            return false;
        }
        else{
            z.innerHTML="";
        }
    }
    function checklogin(){
        var name=document.getElementById("username").value;
        var name_y=document.getElementById("domename");
        var pass=document.getElementById("password").value;
        var pass_y=document.getElementById("domepass");
        var subbtn=document.getElementById("form_submit");
        var pass2=document.getElementById("password2").value;
        var pass2_y=document.getElementById("domepass2");

        if(name==""){
            name_y.innerHTML="么有输入账号啊！！！";
            return false;
        }
        if(pass==""){
            pass_y.innerHTML="么有输入密码啊！！！";
            return false;
        }
        if(pass2==""){
            pass2_y.innerHTML="么有输入确认密码啊！！！";
            return false;
        }
        if(pass!=pass2){
            pass2_y.innerHTML="两次密码不同啊！！！";
            return false;
        }
        if(name!=""&&pass!=""){
            subbtn.onclick=formsub();
        }
    }
    function formsub(){
        var formsub=document.forms["form1"];
        formsub.submit();
    }