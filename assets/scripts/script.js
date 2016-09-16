boardState = [0,0,0,0,0,0,0,0,0];
var playerWinOptions = [];

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

function pushBoardState(id, e) {
    boardState[id - 1] = 1;

    // TODO: Do we even need this if we aren't working with sessions?
    $("#buttonId").val(id);
    
    var page = 'passAjax.php';

    $.ajax({
        url: page,
        type: "post",
        data: {id:boardState},
        async: true,
        success: function (data) {
            console.log(data);
            // document.write(data);
        }
    });

    e.preventDefault()
}
