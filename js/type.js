document.querySelector('.login').style.display = ""
document.querySelector('.login-funcionario').style.display = "none"
document.querySelector('.login-gerente').style.display = "none"

function cliente() {
    document.querySelector('.login').style.display = ""
    document.querySelector('.login-funcionario').style.display = "none"
    document.querySelector('.login-gerente').style.display = "none"
}

function funcionario() {
    document.querySelector('.login').style.display = "none"
    document.querySelector('.login-funcionario').style.display = ""
    document.querySelector('.login-gerente').style.display = "none"
}

function gerente() {
    document.querySelector('.login').style.display = "none"
    document.querySelector('.login-funcionario').style.display = "none"
    document.querySelector('.login-gerente').style.display = ""
}