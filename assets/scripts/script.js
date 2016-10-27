aiWinOptions = [];
playerWinOptions = [];

aiWinOptions[0] = [2, 2, 2, 0, 0, 0, 0, 0, 0];
aiWinOptions[1] = [0, 0, 0, 2, 2, 2, 0, 0, 0];
aiWinOptions[2] = [0, 0, 0, 0, 0, 0, 2, 2, 2];
aiWinOptions[3] = [2, 0, 0, 0, 2, 0, 0, 0, 2];
aiWinOptions[4] = [0, 0, 2, 0, 2, 0, 2, 0, 0];
aiWinOptions[5] = [2, 0, 0, 2, 0, 0, 2, 0, 0];
aiWinOptions[6] = [0, 2, 0, 0, 2, 0, 0, 2, 0];
aiWinOptions[7] = [0, 0, 2, 0, 0, 2, 0, 0, 2];

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

            makeMove(aiMove);
            setBoardStateToAiMove(aiMove, boardState);
            isLosingState(aiMove);

            aiTurn = false;

            console.log(boardState);
        }
    });

    e.preventDefault();
}

function makeMove(aiMove) {
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

function setBoardStateToAiMove(aiMove, boardState) {
    for (var ii = 1; ii < boardState.length + 1; ii++) {
        boardState[ii - 1] = parseInt(aiMove[ii]);
    }
}

function isLosingState(aiMove) {
    var isLosingState = false;

    for (var ii = 0; ii < aiMove.length; ii++) {
        if (aiMove[ii] == "2") {
            aiMove[ii] = "0";
        }
    }

    console.log(aiMove);
}


