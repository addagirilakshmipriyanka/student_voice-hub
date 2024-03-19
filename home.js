
  // Array of voting quotes
  var voteQuotes = [
    `"Your vote is your voice."`,
   ` "Voting is not only our right—it is our power." `,
    `"Don't boo. Vote!"`,
    `"Democracy is not a spectator sport."`,
   `"The future of the world is in your hands. Vote!"`,
    `"Every election is determined by the people who show up."`
  ];

  // Function to generate a random quote
  function generateQuote() {
    var randomIndex = Math.floor(Math.random() * voteQuotes.length);
    var randomQuote = voteQuotes[randomIndex];
    document.getElementById("quote").innerHTML = randomQuote;
  }

  // Generate a quote initially
  generateQuote();

  // Set interval to generate a new quote every 10 seconds (adjust as needed)
  setInterval(generateQuote, 10000);

  //Typing effect
  $(document).ready(function() {
    $('.typing-effect p').each(function(index) {
      $(this).delay(3000 * index).queue(function() {
        $(this).css('animation', 'typing 3s steps(40, end)');
        $(this).dequeue();
      });
    });
  });