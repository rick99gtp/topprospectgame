let d = new Date();
let cpy = document.querySelector('.cpy');

cpy.innerHTML = "Copyright &copy; " + d.getFullYear() + ". All rights reserved.";

let random_quotes = ["Baseball is 90% mental. The other half is physical.", "Baseball was, is, and always will be the best game in the world to me.", "If my uniform doesn't get dirty, I haven't done anything in the baseball game.", "People ask me what I do in the winter when there's no baseball. I'll tell you what I do. I stare out the window and wait for spring.", "I'd walk through hell in a gasoline suit to play baseball.", "Fans don't boo nobodies.", "One of the beautiful things about baseball is the history.", "It's unbelievable how much you don't know about the game you've been playing your whole life.", "I could have played baseball another year, but I would have been playing for the money, and baseball deserves better than that.", "They give you a round bat, and they throw you a round ball, and then they tell you to hit it square.", "Well, it took me 17 years to get 3,000 hits in baseball, and I did it in one afternoon on the golf course.", "The way to make coaches think you're in shape in the spring is to get a tan.", "Baseball is like a poker game. Nobody wants to quit when he's losing; nobody wants you to quit when you're ahead.", "I never had a job. I just always played baseball.", "I'm a guy who just wanted to see his name in the lineup everyday. To me, baseball was a passion to the point of obsession.", "A baseball game is simply a nervous breakdown divided into nine innings.", "Remember these two things: play hard and have fun.", "Baseball was 100% of my life.", "I am convinced that God wanted me to be a baseball player.", "When I was up there at the plate, my purpose was to get on base any way I could, whether by hitting or getting hit.", "There is no room in baseball for discrimination. It is our national pastime and a game for all.", "If you have a bad day in baseball and start thinking about it, you will have 10 more.", "You could be a kid for as long as you want when you play baseball.", "If you're going to play at all, you're out to win. Baseball, board games, Jeopardy, I hate to lose.", "I think I was the best baseball player I ever saw."];
let random_quotes_author = ["Yogi Berra", "Babe Ruth", "Rickey Henderson", "Rogers Hornsby", "Pete Rose", "Mr. October, Reggie Jackson", "James Anthony Abbott", "Mickey Mantle", "George Brett", "Willie Stargell", "Hank Aaron", "Whitey Ford", "Jackie Robinson", "Satchel Paige", "Brooks Robinson", "Robert Earl Wilson", "Tony Gwynn", "Ty Cobb", "Roberto Clemente", "Shoeless Joe Jackson", "Lou Gehrig", "Sammy Sosa", "Cal Ripken, Jr.", "Derek Jeter", "Willie Mays"];

let rq_length = random_quotes.length;

let random_quote = document.querySelector('.random-quote');
let random_quote_author = document.querySelector('.random-quote-author');

let quote_generator_started = false;

let quoteNum = Math.floor(Math.random() * rq_length);

function startQuoteGenerator() {
    setInterval(getQuote, 6500);
}

function getQuote() {

    quoteNum === rq_length-1 ? quoteNum = 0 : quoteNum++;

    random_quote.innerHTML = random_quotes[quoteNum];
    random_quote_author.innerHTML = random_quotes_author[quoteNum];   

}

let element_1 = document.querySelector('.quote-top');
let element_2 = document.querySelector('.quote-bottom');

window.addEventListener('scroll', function() {

    let position_1 = element_1.getBoundingClientRect();

	// checking for partial visibility
	if(position_1.top < (window.innerHeight - 100) && position_1.bottom >= 0) {

        if(!quote_generator_started) {
            element_1.style.animation = "el-fade-in 6.5s ease-in-out infinite, el-shift-right 6.5s ease-out infinite";
            element_2.style.animation = "el-fade-in-2 6.5s ease-in-out infinite, el-shift-left 6.5s ease-out infinite";
            quote_generator_started = true;
            getQuote();
            startQuoteGenerator();
        }
    }

});
