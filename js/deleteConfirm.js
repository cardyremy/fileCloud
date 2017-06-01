/**
 * Created by Cardyre on 15.05.2017.
 */
function deleteConf(param)
{
    var result = confirm("Voulez-vous vraiment supprimer la page "+ param +"?");

    return result;
}

function deleteDefinitly()
{
    var result = confirm("Voulez-vous recuperer vos fichiers ?");
    setTimeout(function()
    {result=true },10000);
    //window.location="../php/definitlyDelete.php"
    return result;
}

function deleteConfFile(param)
{
    var result = confirm("Voulez-vous vraiment supprimer le fichier "+ param +"?");
    return result;
}