main()
// Llamo por primera vez la funcion para setear por primera vez el precio del bitcoin
setPrecioBTC();
// Llamo a la funcion que setea el precio del bitcoin cada 2 segundos
setInterval(setPrecioBTC, 2000);

// Esta funcion se encarga de setear el valor del precio del bitcoin en el html
async function setPrecioBTC(){
    const bitcoinPriceUSD = await callAPI(1, 'btc', true)
    document.getElementById('precioBitcoin').innerHTML = "Precio Bitcoin: $" + bitcoinPriceUSD + " USD";
}
// Esta funcion se encarga de agregar los event listeners a los inputs y asignarles las funciones correspondientes
// para que se actualice de forma dinamica el valor de los inputs
async function main() {
    try {
        document.getElementById('inputUSD').addEventListener('input', handleInputUSDChange);
        document.getElementById('inputBTC').addEventListener('input', handleInputBTCChange);
    } catch (error) {
        console.log(error);
    }
}

// Estas funciones se encargan de setear el valor de los inputs de acuerdo al tipo de moneda que se quiere convertir
async function setBTC(amount, type) {
    const totalBtc = await callAPI(amount, type, false)
    if (!isNaN(totalBtc)) {
        document.getElementById('inputBTC').value = totalBtc;
    } else {
        document.getElementById('inputBTC').value = "";
    }
}
async function setUSD(amount, type) {
    const totalUsd = await callAPI(amount, type, false);
    if (!isNaN(totalUsd)) {
        document.getElementById('inputUSD').value = totalUsd;
    } else {
        document.getElementById('inputUSD').value = "";
    }
}
// Esta funcion se encarga de llamar a la api y devolver el resultado de la conversion
// Se le pasa el amount que es el valor que se quiere convertir, el type que es el tipo de moneda
// refresh es un booleano que indica si es un llamado para refrescar el valor o para guardar un valor en la db
// lo uso para no sobrecargar la base de datos con los llamados cada 2 segundos que hago en el setinterval
async function callAPI(amount, type, refresh){ 
    try {
        const {data} = await axios.post('/api/conversion', {amount: amount, type: type, refresh: refresh});
        return data;
     } catch (error) {
        console.log(error);
    }
}

let timerId; 
// En las siguientes funciones aplico el debounce que nombre en la consulta por mail para que no envie llamados
// a la api cada vez que se presiona una tecla, sino que espere a que el usuario termine de escribir.
function handleInputUSDChange() {
  clearTimeout(timerId); 

  timerId = setTimeout(() => {
    const usdAmount = document.getElementById('inputUSD').value;
    if (usdAmount !== '') {
      setBTC(usdAmount, 'usd');
    }
  }, 1200);
}

function handleInputBTCChange() {
  clearTimeout(timerId); 

  timerId = setTimeout(() => {
    const btcAmount = document.getElementById('inputBTC').value;
    if (btcAmount !== '') {
      setUSD(btcAmount, 'btc');
    }
  }, 1200);
}
