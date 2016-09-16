/**
 * Created by denni on 14-9-2016.
 */
boardState = [0,0,0,0,0,0,0,0,0];
var playerWinOptions = [];
var aiWinOptions = [];

//Player
//Diagonal
playerWinOptions[0] = [1, 1, 1, 0, 0, 0, 0, 0, 0];
playerWinOptions[1] = [0, 0, 0, 1, 1, 1, 0, 0, 0];
playerWinOptions[2] = [0, 0, 0, 0, 0, 0, 1, 1, 1];
//Oblique
playerWinOptions[3] = [1, 0, 0, 0, 1, 0, 0, 0, 1];
playerWinOptions[5] = [0, 0, 1, 0, 1, 0, 1, 0, 0];
//Vertical
playerWinOptions[6] = [1, 0, 0, 1, 0, 0, 1, 0, 0];
playerWinOptions[7] = [0, 1, 0, 0, 1, 0, 0, 1, 0];
playerWinOptions[8] = [0, 0, 1, 0, 0, 1, 0, 0, 1];

//AI
//Diagonal
// aiWinOptions[0] = [1, 1, 1, 0, 0, 0, 0, 0, 0];
// aiWinOptions[1] = [0, 0, 0, 1, 1, 1, 0, 0, 0];
// aiWinOptions[2] = [0, 0, 0, 0, 0, 0, 1, 1, 1];
// //Oblique
// aiWinOptions[3] = [1, 0, 0, 0, 1, 0, 0, 0, 1];
// aiWinOptions[5] = [0, 0, 1, 0, 1, 0, 1, 0, 0];
// //Vertical
// aiWinOptions[6] = [1, 0, 0, 1, 0, 0, 1, 0, 0];
// aiWinOptions[7] = [0, 1, 0, 0, 1, 0, 0, 1, 0];
// aiWinOptions[8] = [0, 0, 1, 0, 0, 1, 0, 0, 1];

function pushBoardState(id, e) {
    boardState[id - 1] = 1;

    $("#buttonId").val(id);
}

    var page = 'test.php';
    $.ajax({
        url: page,
        type: "post",
        data: {id:boardState},
        async: true,
        success: function (data) {
            console.log(data);
        }
    });
    e.preventDefault()
}
