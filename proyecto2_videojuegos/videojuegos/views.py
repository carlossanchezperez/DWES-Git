
from django.shortcuts import render
from .models import Videojuego, Cliente, Pedido


def lista_videojuegos(request):
    videojuegos = Videojuego.objects.all()
    return render(
        request,
        "videojuegos/videojuegos.html",
        {"videojuegos": videojuegos}
    )


def lista_clientes(request):
    clientes = Cliente.objects.all()
    return render(
        request,
        "videojuegos/clientes.html",
        {"clientes": clientes}
    )


def lista_pedidos(request):
    pedidos = Pedido.objects.select_related(
        "videojuego", "cliente"
    ).all()
    return render(
        request,
        "videojuegos/pedidos.html",
        {"pedidos": pedidos}
    )
