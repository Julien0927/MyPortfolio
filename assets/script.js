const cardsData = [
    {
        img: 'assets/img/photo14.jpg',
        title: 'Semimarathon de La Rochelle',
        text: "First official website!!! It was created for the 43rd edition of the La Rochelle half marathon.",
        link: "https://semimarathonlarochelle.fr/",
        technologies: ["HTML", "CSS", "PHP"]
    },
    {
        img: 'assets/img/willrunexpert.png',
        title: 'WillRunExpert',
        text: "Individual coaching website to improve running performance.",
        link: "https://willrunexpert.fr/",
        technologies: ["HTML", "SASS", "PHP", "MySQL"]
    },
    {
        img: 'assets/img/default.jpg',
        title: 'Currently in development',
        text: "Currently in development",
        link: "#",
        technologies: []
    },

];

function displayCards(cards) {
    const container = document.getElementById('cardsContainer'); // Assure-toi d'avoir un élément avec id="cardsContainer" dans ton HTML
  
    cards.forEach(card => {
      const colDiv = document.createElement('div');
      colDiv.classList.add('col-md-4');
  
      const cardDiv = document.createElement('div');
      cardDiv.classList.add('card');
  
      const img = document.createElement('img');
      img.setAttribute('src', card.img);
      img.setAttribute('alt', card.title);
      img.classList.add('card-img-top');
  
      const cardBodyDiv = document.createElement('div');
      cardBodyDiv.classList.add('card-body');
  
      const title = document.createElement('h5');
      title.classList.add('card-title');
      const titleLink = document.createElement('a');
      titleLink.setAttribute('href', card.link);
      titleLink.textContent = card.title;
      title.appendChild(titleLink);
  
      const text = document.createElement('p');
      text.classList.add('card-text');
      text.textContent = card.text;
  
      cardBodyDiv.appendChild(title);
      cardBodyDiv.appendChild(text);
  
      card.technologies.forEach(tech => {
        const button = document.createElement('button');
        button.classList.add('btn');
        button.textContent = tech;
        button.style.marginRight = "10px";
        cardBodyDiv.appendChild(button);
      });
  
      cardDiv.appendChild(img);
      cardDiv.appendChild(cardBodyDiv);
      colDiv.appendChild(cardDiv);
  
      container.appendChild(colDiv);
    });
  }
  document.addEventListener('DOMContentLoaded', () => {
    displayCards(cardsData);
  });

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Empêche la soumission standard du formulaire

        const formData = new FormData(this); // Crée un objet FormData à partir du formulaire

        fetch('contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('La requête a échoué');
        })
        .then(text => {
            showCustomAlert('Message envoyé avec succès');
            // Ici, tu peux également nettoyer le formulaire ou rediriger l'utilisateur
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi du formulaire:', error);
            showCustomAlert('Erreur lors de l\'envoi du message');
        });
    });
});

function showCustomAlert(message) {
    document.getElementById('customAlertMsg').textContent = message;
    document.getElementById('customAlert').style.display = 'flex'; // Affiche la modal
}

function closeCustomAlert() {
    document.getElementById('customAlert').style.display = 'none'; // Cache la modal
}