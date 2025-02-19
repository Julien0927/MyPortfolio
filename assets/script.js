const cardsData = [
    {
        img: 'assets/img/photo14.jpg',
        title: 'Semimarathon de La Rochelle',
        text: "First official website!!! It was created for the 43rd edition of the La Rochelle half marathon.",
        link: "https://semimarathonlarochelle.fr/",
        technologies: ["CSS", "PHP"]
    },
    {
        img: 'assets/img/Cacds.png',
        title: 'CACDS',
        text: "Multisports association located in Niort (Deux-Sèvres)",
        link: "https://julienvarachas.alwaysdata.net/cacds/",
        technologies: [ "PHP","BOOTSTRAP" ]
    },
    {
        img: 'assets/img/mammamia.png',
        title: 'Mamma Mia',
        text: "Italian restaurant website, near La Rochelle (Périgny).",
        link: "https://mammamia-lr.com/",
        technologies: ["SASS", "PHP"]
    },

];

function displayCards(cards) {
    const container = document.getElementById('cardsContainer'); 
  
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
      title.classList.add('card-title', 'titleCardToChange');
      const titleLink = document.createElement('a');
      titleLink.setAttribute('href', card.link);
      titleLink.textContent = card.title;
      title.appendChild(titleLink);
  
      const text = document.createElement('p');
      text.classList.add('card-text', 'textCardToChange');
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

document.addEventListener('DOMContentLoaded', () => {
   const frenchFlag = document.getElementById('frenchFlag');
   const britishFlag = document.getElementById('britishFlag');
   const textsToChange = document.querySelectorAll('.textToChange');
   const titleToChange = document.querySelectorAll('.titleToChange');
   const textCardsToChange = document.querySelectorAll('.textCardToChange');
   const titleCardsToChange = document.querySelectorAll('.titleCardToChange');

    frenchFlag.addEventListener('click', () => {

        const frenchTexts = [
            'Accueil',
            'Projets',
            'Technos',
            'À propos',
            'Contact',
            'JE SUIS JULIEN',
            'Développeur Web Full Stack',
            'Découvrez mes projets',
            'Bonjour ! Je suis Julien, un développeur web passionné par la création de solutions numériques élégantes et performantes. Ce qui me motive chaque jour, c\'est l\'opportunité de transformer une idée abstraite en une application web fonctionnelle qui répond aux besoins des utilisateurs. Si vous recherchez quelqu\'un qui peut non seulement coder mais aussi apporter des idées créatives et des solutions efficaces, je suis le candidat idéal.',
            'Prénom',
            'Nom',
            'Email',
            'Votre message',
            'Envoyer',
        ]
         
        const frenchTitles = [
            'MES PROJETS',
            'TECHNOS',
            'QUI SUIS-JE ?',
        ]

        const frenchTextCards = [
            '1er site officiel du semi-marathon de La Rochelle, créé pour la 43ème édition.',
            'Association multisports située à Niort (Deux-Sèvres).',
            'Brasserie italienne située à La Rochelle (Périgny).',
        ]

        const frenchTitleCards = [
            'Semimarathon de La Rochelle',
            'CACDS',
            'Mamma Mia',
        ]

        textsToChange.forEach((text, index) => {
            text.textContent = frenchTexts[index];
        });

        titleToChange.forEach((title, index) => {
            title.textContent = frenchTitles[index];
        });

        textCardsToChange.forEach((textCard, index) => {
            textCard.textContent = frenchTextCards[index];
        });
        titleCardsToChange.forEach((titleCard, index) => {
            titleCard.textContent = frenchTitleCards[index];
        });
    });

});