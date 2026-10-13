
from django.urls import path
from . import views

urlpatterns = [
    path("", views.inicio, name="inicio"),
    path("animales/", views.lista_animales, name="lista_animales"),
    path("protectoras/", views.lista_protectoras, name="lista_protectoras"),
    path("colaboradores/", views.lista_colaboradores, name="lista_colaboradores"),
]
