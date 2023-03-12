$("#myform").validate({
			rules:{
				txtcatname:"required",
				txtcatimg: {
                required: function() {
                //    return $("#oldimg").val() === "" ? true : false;
                },
                extension: "jpg,jpeg,png"
            }
				
			},
			messages:{
				txtcatname:"Please Enter Category Name",
				txtcatimg: {
                required: "Category image is required",
                extension: "Upload only image of type .jpg or .jpeg or .png"
            }
			}
		});