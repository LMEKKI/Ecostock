// Exemple : Gérer le clic sur un bouton avec Fetch
document
  .querySelector("RemoveElementInCart")
  .addEventListener("click", function () {
    fetch("/removeElement ", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("retour de symfo la bitch : " + data.message);
      })
      .catch((error) => console.error("si y'a une putain d'erreur  :", error));
  });

// document.querySelector("updateCart").addEventListener("click", function () {
//   fetch("/updateCart", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json",
//       "X-Requested-With": "XMLHttpRequest",
//     },
//     body: JSON.stringify({ key: "value" }), // Données envoyées au serveur
//   })
//     .then((response) => response.json()) // Convertir la réponse en JSON
//     .then((data) => {
//       // Afficher la réponse Symfony
//       alert("Réponse Symfony : " + data.message);
//     })
//     .catch((error) => console.error("Erreur :", error)); // Gérer les erreurs
// });
