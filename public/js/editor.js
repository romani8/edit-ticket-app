tinymce.init({
    selector: '#description',
    height: 300,
    width: '100%',
    menubar: true,
    toolbar_mode: 'sliding',
    branding: false,
    plugins: 'fullscreen print preview media link image lists advlist autolink textcolor',
    toolbar: 'fullscreen | undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor ',
    content_style: 'body {font-family: Helvetica,Arial,sans-serif; font-size:14px}',
  });
  