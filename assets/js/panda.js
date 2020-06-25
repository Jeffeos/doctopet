const petStates = [
    'danceState',
    'walkState',
    'playState',
    'idleState',
]
const danceStates = [
    'danceFront',
    'danceBack',
    'danceShake',
]
const moveState = [
    'walkLeft',
    'walkRight',
]
const playState = 'play'
const idleState = 'idle'

let currentState = 'walkState'
let currentDanceState = 'danceFront'
let walkDirection = "left"
let i = 0

setInterval(function () {
    let active = document.getElementsByClassName('activated')
    active[0].classList.toggle("activated")
    let actived = document.getElementsByClassName('activate')
    actived[0].classList.toggle("activate")

    switch (currentState) {
        case "walkState":

            document.getElementById('panda-move').classList.add("activate")

            if (i == 0) {
                document.getElementsByClassName('panda-container')[0].classList.replace(
                    "panda-container",
                    "panda-container-left"
                )
                i++
            } else if (i == 1) {
                document.getElementsByClassName('panda-container-left')[0].classList.replace(
                    "panda-container-left",
                    "panda-container"
                )
                walkDirection = 'right'
                i++
            } else if (i == 2) {
                document.getElementsByClassName('panda-container')[0].classList.replace(
                    "panda-container",
                    "panda-container-right"
                )
                i++
            } else {
                document.getElementsByClassName('panda-container-right')[0].classList.replace(
                    "panda-container-right",
                    "panda-container"
                )
                walkDirection = 'left'
                i = 0
            }

            if (walkDirection == 'left')
                document.getElementById('panda-walk-left').classList.add("activated")
            else
                document.getElementById('panda-walk-right').classList.add("activated")
            break;
        case "danceState":
            document.getElementById('panda-stay').classList.add("activate")
            document.getElementById('panda-front-dance').classList.add("activated")
            break;
        case "playState":
            document.getElementById('panda-stay').classList.add("activate")
            document.getElementById('panda-play').classList.add("activated")
            break;
        case "idleState":
            document.getElementById('panda-stay').classList.add("activate")
            document.getElementById('panda').classList.add("activated")
            break;
    }
}, 1000);

function changeDance() {
    setInterval(function () {
        currentDanceState = danceStates[Math.floor(Math.random() * danceStates.length)]
        switch (currentDanceState) {
            case 'danceFront':
                document.getElementById('panda-front-dance').classList.add("activated")
                break;
            case 'danceBack':
                document.getElementById('panda-back-dance').classList.add("activated")
                break;
            case 'danceShake':
                document.getElementById('panda-shake-dance').classList.add("activated")
                break;
        }
    }, 5000)
}

function changeTheVariableToWalk() {
    currentState = 'walkState';
    console.log('walking')
}

function changeTheVariableToPlay() {
    currentState = 'playState';
    console.log('play')
}

function changeTheVariableToDance() {
    currentState = 'danceState';
    console.log('dance')
}