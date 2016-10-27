playerWinOptions = [];

playerWinOptions[0] = [1, 1, 1, 0, 0, 0, 0, 0, 0];
playerWinOptions[1] = [0, 0, 0, 1, 1, 1, 0, 0, 0];
playerWinOptions[2] = [0, 0, 0, 0, 0, 0, 1, 1, 1];
playerWinOptions[3] = [1, 0, 0, 0, 1, 0, 0, 0, 1];
playerWinOptions[4] = [0, 0, 1, 0, 1, 0, 1, 0, 0];
playerWinOptions[5] = [1, 0, 0, 1, 0, 0, 1, 0, 0];
playerWinOptions[6] = [0, 1, 0, 0, 1, 0, 0, 1, 0];
playerWinOptions[7] = [0, 0, 1, 0, 0, 1, 0, 0, 1];

boardState = [0,0,0,0,0,0,0,0,0];
aiTurn = false;

function pushBoardState(id, e) {
    var page = 'passAjax.php';
    if (!aiTurn) {
        $("#"+ id).html("O");
        boardState[id - 1] = 1;
        aiTurn = true;
    }
    
    $.ajax({
        url: page,
        type: "post",
        data: {boardState:boardState, aiTurn: aiTurn},
        async: true,
        success: function (data) {
            var aiId = "";
            var aiMove = [];
            aiMove = data;

            setBoardStateToAiMove(aiMove, boardState);

            if (!isLosingState(boardState))
                makeMove(aiMove);
            else
                makeDefendingMove(aiMove);


            console.log(boardState);
            aiTurn = false;
        }
    });

    e.preventDefault();
}

function makeMove(aiMove) {
    if (!isLosingState(boardState)) {
        idsToCheck = [];
        aiId = "";

        for (var ii = 0; ii < aiMove.length; ii++) {
            if (aiMove[ii] == "2") {
                if ($("#" + ii).html() != "X") {
                    idsToCheck.push(ii);
                }
            }
        }

        idsToCheck.forEach(function(id) {
            var selector = $("#"+ id);

            if (selector.html() != "X") {
                selector.html("X");
            }

            var index = idsToCheck.indexOf(id);

            if (index > -1) {
                idsToCheck.splice(index, 1);
            }
        });
    }
}

function makeDefendingMove(aiMove) {
    for (var ii = 0; ii < aiMove.length; ii++) {
        var selector = $("#"+ ii);

        if (aiMove[ii] == 1) {
            if (selector.html() != "O") {
                selector.html("X");
            }
        }
    }
}

function setBoardStateToAiMove(aiMove, boardState) {
    for (var ii = 1; ii < boardState.length + 1; ii++) {
        boardState[ii - 1] = parseInt(aiMove[ii]);
    }
}

function isLosingState(boardState) {
    var isLosingState = false;

    for (ii = 0; ii < playerWinOptions.length; ii++) {
        if (boardState.equals(playerWinOptions[ii])) {
            isLosingState = true;
        }
    }

    return isLosingState;
}

Array.prototype.equals = function equals (array) {
    if (!array) {
        return false;
    }

    if (this.length != array.length) {
        return false;
    }

    for (var i = 0, l = this.length; i < l; i++) {
        if (this[i] instanceof Array && array[i] instanceof Array) {
            if (!this[i].equals(array[i])) {
                return false;
            }
        }

        else if (this[i] != array[i]) {
            return false;
        }
    }

    return true;
};


