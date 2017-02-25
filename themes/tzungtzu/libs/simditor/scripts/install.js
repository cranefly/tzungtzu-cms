//var toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'];
//var mobileToolbar = ["bold", "underline", "strikethrough", "color", "ul", "ol"];
//if (mobilecheck()) {
//  toolbar = mobileToolbar;
//}

var editor = new Simditor({
    textarea: $('#simditor_editor'),
    placeholder : '请填写内容',
	toolbarFloat : false,
	toolbar :  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'],
    upload : {
        url : '/webmaster/upload/file_upload', //文件上传的接口地址
        params: '', //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
        fileKey: 'Filedata', //服务器端获取文件数据的参数名
        connectionCount: 3,
        leaveConfirm: '正在上传文件'
    }
  //optional options
});
