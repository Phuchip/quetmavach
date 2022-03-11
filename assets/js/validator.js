function validator(formSelector) {
    var _isthis = this;
    var formRules ={};
    var passworkBefore;
    function getParent(element, selector) {
        while(element.parentElement){
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }element = element.parentElement;

        }
    }
    var validatorRules = {
        required : function (value) {
            return value ? undefined : "Vui lòng nhập trường này";
        },
        fullname: function (value) {
            var regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/;
            return regex.test(value) ? undefined : "Vui lòng nhập tên hợp lệ";
        },
        phone: function (value) {
            var regex = /(?=.*?\d{3}( |-|.)?\d{4})((?:\+?(?:1)(?:\1|\s*?))?(?:(?:\d{3}\s*?)|(?:\((?:\d{3})\)\s*?))\1?(?:\d{3})\1?(?:\d{4})(?:\s*?(?:#|(?:ext\.?))(?:\d{1,5}))?)\b/i;
            return regex.test(value) ? undefined : "Vui lòng nhập số điện thoại hợp lệ";
        },
        email: function (value) {
            var regex =  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regex.test(value) ? undefined : "Vui lòng nhập email";
        },
        number: function (value) {
            var regex =  /^\d+$/;
            return regex.test(value) ? undefined : "Vui nhập số nguyên hợp lệ";
        },
        min: function (min) {
            return function (value) {
                return value.length >= min ? undefined : `Vui lòng nhập ít nhất ${min} kí tự`;
            }
        },
        password: function (value) {
            var regex = /^(?!.* )(?=.*\d).{8,}$/g;  
            return regex.test(value) ? undefined : "Mật khẩu bao gồm chữ cái và số";
        },
        password_confirmation: function (pass) {
            return function (value) {
                return value === pass ? undefined : "Mật khẩu không chính xác";
            }
        },
        select: function (value) {
            return value != 0 ? undefined : "Vui lòng chọn trường này"; 
        }
    }
   
   
    var formElement = document.querySelector(formSelector);
    if(formElement){
        var inputs = formElement.querySelectorAll('[name][rules]');
        for(input of inputs){
            if(input.name == "password"){
                passworkBefore = input;
            }
            var rules =  input.getAttribute('rules').split('|');
            for(rule of rules){
                var isRuleHasValue = rule.includes(":");
                var ruleInfo;
                if(isRuleHasValue){
                    ruleInfo = rule.split(':');
                    rule = ruleInfo[0];
                }
                var ruleFunc = validatorRules[rule];
                if (isRuleHasValue) {
                    ruleFunc = ruleFunc(ruleInfo[1]);
                }
                if(Array.isArray(formRules[input.name])){
                    formRules[input.name].push(ruleFunc);
                }else{
                    formRules[input.name] = [ruleFunc];
                }
            }
            //formRules[input.name] =  input.getAttribute('rules');
        }
    }
    //confirm password
    if(passworkBefore != null){
         passworkBefore.onchange = function () {
        if (passworkBefore.value) {
            //console.log(passworkBefore.value);
        var input = formElement.querySelector('[name][rePass]');
            if(input){
                var rule = input.getAttribute('rePass');
                   //console.log(rule);
                var ruleFunc = validatorRules[rule];
                    ruleFunc = ruleFunc(passworkBefore.value);
                    formRules[rule] = [ruleFunc];
                 //  console.log(validatorRules);
            }
        }
    }
  
    }
   

    var inputs = formElement.querySelectorAll('[name][rules]');
    if(inputs){
        for(input of inputs){
            var setElement = input.getAttribute("rules");
            if (setElement == "select") {
                input.onchange = handleClearError;
            }else{
                input.onblur = handleValidator;
                input.oninput = handleClearError;
            }
           
        }
          //ham su kien validate
          function handleValidator(event){
            var rules =  formRules[event.target.name];
            var errorMessage;
            for(var rule of rules){
                errorMessage = rule(event.target.value);
                if(errorMessage) break;
            }
            //báo lỗi
           if(errorMessage){
            var formGroup = getParent(event.target,'.t-form-group');
            var  isEle = event.target;
            isEle.classList.add('invalid');
                if (formGroup) {
                    var formMessage = formGroup.querySelector('.form-message');
                    if (formMessage) {
                        formMessage.innerText = errorMessage;
                    }
                }
           }
           return !errorMessage;
        }
        function handleClearError(event){
            var formGroup = getParent(event.target,'.t-form-group');
            var  isEle = event.target;
            if (isEle.classList.contains("invalid")) {
                isEle.classList.remove('invalid');
                var formMessage = formGroup.querySelector('.form-message');
                if (formMessage) {
                    formMessage.innerText ='';
                }
            }
        }
    }

 //console.log(formRules);
    /* submit form*/
    console.log(this);
    formElement.onsubmit = function (event) {
        event.preventDefault();
        var inputs = formElement.querySelectorAll('[name][rules]');
        var isValid = true;
        for(input of inputs){
            if (!handleValidator({target: input})) {
                isValid = false;
            }
        }
        if (isValid) {
            if (typeof _isthis.onSubmit === "function") {
                var enableInputs = formElement.querySelectorAll('[name]');
                var formValues = Array.from(enableInputs).reduce(function (values, input) {
                    switch(input.type) {
                        case 'radio':
                            values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                            break;
                        case 'checkbox':
                            if (!input.matches(':checked')) {
                                values[input.name] = '';
                                return values;
                            }
                            if (!Array.isArray(values[input.name])) {
                                values[input.name] = [];
                            }
                            values[input.name].push(input.value);
                            break;
                        case 'file':
                            values[input.name] = input.files[0];
                            break;
                        default:
                            values[input.name] = input.value;
                    }
                    return values;
                }, {});
                _isthis.onSubmit(formValues);
            }else{
            formElement.submit();
            }
        }
    }
}
/**
   rePass="password_confirmation" // attribute;
 */

/*
    prentElement:  (.t-form-group)
    erro_message: (.form-message)
*/ 


/** form submit:
   || new validator('#form1'); 
 */

/** ajax:
var form = new validator('#form1');
form.onSubmit = function (formData) {
    console.log(formData);
}

*/