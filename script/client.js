const firebaseConfig = {
    apiKey: "AIzaSyAKyak_Tw2mRIyYj2f7uUXaz0qml9S2mBk",
    authDomain: "ptracking-89393.firebaseapp.com",
    databaseURL: "https://ptracking-89393-default-rtdb.firebaseio.com",
    projectId: "ptracking-89393",
    storageBucket: "ptracking-89393.appspot.com",
    messagingSenderId: "698946787774",
    appId: "1:698946787774:web:a363c4e9b705ea5b0981ef"
};

function searchPackage() {
    const searchInput = document.getElementById('search').value;
    database.ref('packages/' + searchInput).once('value', (snapshot) => {
        const packageData = snapshot.val();
        const searchResult = document.getElementById('search-result');
        if (packageData) {
            searchResult.innerHTML = `
                <h3>Package Details</h3>
                <p><strong>Tracking Number:</strong> ${searchInput}</p>
                <p><strong>Name:</strong> ${packageData.name}</p>
                <p><strong>Location:</strong> ${packageData.location}</p>
                <p><strong>Status:</strong> ${packageData.status}</p>
            `;
        } else {
            searchResult.innerHTML = 'Package not found.';
        }
    });
}