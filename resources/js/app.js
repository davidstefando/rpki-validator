import './bootstrap';

var loading = document.getElementById('loading');
var validationResult = document.getElementById('validationResult')
var ispName;

function checkValidRoute()
{
    fetch('https://valid.rpki.isbgpsafeyet.com/', {
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then((text) => {
            setIspName(text.name)
            checkInvalidRoute()
        })
        .catch(function(error){

        })
}

function checkInvalidRoute()
{
    fetch('https://invalid.rpki.isbgpsafeyet.com/', {
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then((text) => {
            checkResultIsInvalid()
        })
        .catch(function(error){
            checkResultIsValid()
        })
}

function setIspName(name)
{
    ispName = name;
}

function checkResultIsValid()
{
    var checkResult = "<img src='/images/rpki-valid.png' class='w-64 mb-4'> Your ISP <span class='font-bold'>" + ispName + "</span> have implemented Drop BGP RPKI Invalid, you're secured"
    loading.style.display = "none";
    validationResult.style.display = "block";
    validationResult.innerHTML = checkResult;
    validationResult.classList.add('border-x-valid')
}

function checkResultIsInvalid()
{
    var checkResult = "<img src='/images/rpki-invalid.png' class='w-64 mb-4'> Unfortunately, your ISP <span class='font-bold'>" + ispName + "</span> haven't implemented Drop BGP RPKI Invalid"
    loading.style.display = "none";
    validationResult.style.display = "block";
    validationResult.innerHTML = checkResult;
    validationResult.classList.add('border-x-invalid');
}


checkValidRoute()
