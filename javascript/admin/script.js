function Editmode(labelname, textboxname)
{
	labels = document.getElementsByName(labelname);
	for(i=0; i<labels.length; i++)
	{
		if(labels[i].style.display=="none")
			labels[i].style.display = "";
		else
			labels[i].style.display = "none";
	}
	inputs = document.getElementsByTagName('input');
	for(i=0; i<inputs.length; i++)
	{
		if(inputs[i].type == 'text')
			if(inputs[i].name.indexOf(textboxname) == 0)
			{
				if(inputs[i].style.display=="none")
					inputs[i].style.display = "";
				else
					inputs[i].style.display = "none";
			}
	}
}

function openUploadImageForm(id, url)
{
	if(url.substring(url.length-5) == '.html')
		url = url.substring(0, url.length-5);
	uploadForm = window.open(url + '/' + id, 'new_page', 'width=400,height=150');
}

function insertImage(id, imageUrl)
{
	instance = tinyMCE.get(id);
	instance.execCommand("mceInsertContent", false, '<img src="' + imageUrl + '"/>');
	
}