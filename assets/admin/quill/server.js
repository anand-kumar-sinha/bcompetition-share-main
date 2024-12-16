
var server_upload = {
              upload: file => {
                return new Promise((resolve, reject) => {
                  const fd = new FormData();
                  fd.append("file", file);

                  const xhr = new XMLHttpRequest();
                  xhr.open(
                    "POST",
                    `http://web.skwebdesigner.co.in/upload_photo.php`,
                    true
                  );
                  //xhr.setRequestHeader("adstrackid", document.getElementById("adstrackid").innerHTML.trim());

                  xhr.onload = () => {
                    if (xhr.status === 200) {
                      const response = JSON.parse(xhr.responseText);
                      console.log(response);
                      resolve(response.url);
                    }
                  };
                  xhr.send(fd);
                });
              }
            }

var custom_toolbar = [
        ["bold", "italic", "underline"],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ["image", "formula"]
      ];