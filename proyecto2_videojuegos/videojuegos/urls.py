from django.urls import path
from . import views

urlpatterns = [
    path("videojuegos/", views.lista_videojuegos, name="lista_videojuegos"),
    path("clientes/", views.lista_clientes, name="lista_clientes"),
    path("pedidos/", views.lista_pedidos, name="lista_pedidos"),
]
