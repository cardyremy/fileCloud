/**
 * Created by Cardyre on 16.05.2017.
 */


function displayHide()
{
    var x = document.getElementById('titleHide');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}


function changeType()
{
    if(document.getElementById('hybrid').type == 'hidden')
    {
        document.getElementById('hybrid').type = 'text';
        document.getElementById("change").className = "medium-3 columns";
    }
    else
    {
        document.getElementById('hybrid').type = 'hidden';
        document.getElementById("change").className = "hide";

    }
    return changeType();
}

