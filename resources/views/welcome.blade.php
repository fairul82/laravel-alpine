<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body>
<div x-data="game()" class="px-10 flex items-center justify-center min-h-screen">
    <h1 class="fixed top-0 right-0 p-10 font-bold text-3xl" x-text="points"></h1>
    <div class="flex-1 grid grid-cols-4 gap-10">
        <template x-for="card in cards">
            <div>
                <button x-show="! card.cleared"
                        :style="'background:'+ (card.flipped ? card.color : '#999')"
                        class="w-full h-32 cursor-pointer"
                        @click="flipCard(card)">

                </button>
            </div>
        </template>
    </div>
</div>
<div x-data="{show:false , message: 'Default Message'}"
     x-show="show"
     x-text="message"
     @flash.window="message= $event.detail.message; show:true;"
     class="fixed bottom-0 right-0 bg-green-500 text-white p-2 mb-4">

</div>
<script>
    function flash(message) {
        window.dispatchEvent(new CustomEvent('flash', {
            detail: {message}
        }));
    }

    function game() {
        return {
            cards: [
                {color: 'green', flipped: false, cleared: false},
                {color: 'green', flipped: false, cleared: false},
                {color: 'blue', flipped: false, cleared: false},
                {color: 'blue', flipped: false, cleared: false},
                {color: 'red', flipped: false, cleared: false},
                {color: 'red', flipped: false, cleared: false},
                {color: 'yellow', flipped: false, cleared: false},
                {color: 'yellow', flipped: false, cleared: false}
            ],
            get clearedCards() {
                return this.cards.filter(card => card.cleared);
            },
            get remainingCards() {
                return this.cards.filter(card => !card.cleared);
            },
            get points() {
                return this.clearedCards.length;
            },
            get flippedCards() {
                return this.cards.filter(card => card.flipped)  //just get flipped is true
            },
            flipCard(card) {
                card.flipped = !card.flipped;
                if (this.flippedCards.length === 2) {
                    if (this.hasMatch()) {
                        flash('You found a match');
                        this.flippedCards.forEach(card => card.cleared = true);

                        //is the game over?
                        //if there is no remaining cards
                        if (!this.remainingCards.length) {
                            alert('you won!');
                        }
                    }
                    this.flippedCards.forEach(card => card.flipped = false);

                }
            },
            hasMatch() {
                return this.flippedCards[0]['color'] === this.flippedCards[1]['color'];

            }
        }
    }
</script>
</body>
</html>
