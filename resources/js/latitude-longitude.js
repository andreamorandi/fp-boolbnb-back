// import { tomtomCall } from "./tomtom-call.js";

const apiKey = "icqraNKAcD0A91G90JmWxaTl0MOJPR3a"
// const fullAddress = document.getElementById("full_address");
const address = "Via Roma 1, 00100 Roma";
// const submitBtn = document.getElementById("submit-btn");
// const form = document.getElementById("create-apartment");

axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}`).then(
    response => {
        console.log(response);
        let latitude = response.data.results[0].position.lat;
        let longitude = response.data.results[0].position.lon;

        console.log(`latitudine ${latitude}`);
        console.log(`longitudine ${longitude}`);

    })
    .catch(error => {
        console.log(error);
    });
// console.log("prova");
// const apiKey = "icqraNKAcD0A91G90JmWxaTl0MOJPR3a"
// const fullAddress = document.getElementById("full_address");
// const address = encodeURIComponent(fullAddress.value);
// const submitBtn = document.getElementById("submit-btn");
// const form = document.getElementById("create-apartment");
// tomtomCall(address, apiKey);

// axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}`, {
//     // headers: {
//     //     'Access-Control-Allow-Origin': '*'
//     // }
// }).then(response => {
//     console.log(response);
//     let latitude = response.data.results[0].position.lat;
//     let longitude = response.data.results[0].position.lon;

//     console.log(`latitudine ${latitude}`);
//     console.log(`longitudine ${longitude}`);
//     return console.log("ullalla");
// }).catch(error => {
//     console.log(error);
// });


// submitBtn.addEventListener('click', (event) => {
//     event.preventDefault();
//     console.log("funge");
//     tomtomCall(address, apiKey);
    // axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}`, {
    //     //     headers: {
    //     //         'Access-Control-Allow-Origin': '*'
    //     //     }
    // }).then(response => {
    //     console.log(response);
    //     let latitude = response.data.results[0].position.lat;
    //     let longitude = response.data.results[0].position.lon;

    //     console.log(`latitudine ${latitude}`);
    //     console.log(`longitudine ${longitude}`);
    // }).catch(error => {
    //     console.log(error);
    // });
// });

