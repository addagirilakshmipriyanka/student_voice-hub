    var votingQuotes = [
        ' "Your vote is your voice." ',
       ' "Voting is not only our right, but it is also our power." ',
       ' "The future of democracy is in your hands. Vote." ',
        ` "Vote like it's your right, because it is." `,
       ` "Voting is the expression of our commitment to ourselves, one another, this country, and this world." `,
       ` "Democracy cannot succeed unless those who express their choice are prepared to choose wisely." `
    ];

    // Function to get a random quote from the array
    function getRandomQuote() {
        var randomIndex = Math.floor(Math.random() * votingQuotes.length);
        return votingQuotes[randomIndex];
    }

    // Function to update the marquee with a new quote
    function updateQuote() {
        var marquee = document.getElementById('quoteMarquee');
        marquee.innerHTML = getRandomQuote();
    }

    // Initial quote update
    updateQuote();

    setInterval(updateQuote, 50000);

    var selectedCard = null;

function selectCard(card) {
    // Deselect the previously selected card
    if (selectedCard !== null) {
        selectedCard.classList.remove('selected');
    }

    // Select the new card
    selectedCard = card;
    selectedCard.classList.add('selected');
}


function confirmation(electionId) {
        if (selectedCard !== null) {
            var candidateName = selectedCard.querySelector('h2').innerText;
            var candidateId = selectedCard.dataset.candidateId;
            var confirmMessage = "Are you sure you want to vote for " + candidateName + " (ID: " + candidateId + ")?";

            if (confirm(confirmMessage)) {
                vote(candidateId,electionId, function(response) {
                    console.log("Server Response: " + response);
                    if (response === "true") {
                        console.log("vote submitted");
                        window.location.href = "thanks_for_voting.php";
                    } else {
                        alert('Try again');
                    }
                });
            }
        } else {
            alert("Sorry..Vote Again !");
        }
    }

    function vote(candidateId,electionId, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "vote_count.php", false);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Call the callback function with the response
                    callback(xhr.responseText.trim());
                }
            }
        };
        xhr.send("candidateId=" + candidateId + "&electionId=" + electionId);
    }


