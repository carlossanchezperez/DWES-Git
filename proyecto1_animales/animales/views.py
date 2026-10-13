from django.shortcuts import render
from .models import Animal, Protectora, Colaborador


def lista_animales(request):
    animales = Animal.objects.select_related("cuidador").all()
    return render(
        request,
        "animales/animales.html",
        {"animales": animales}
    )


def lista_protectoras(request):
    protectoras = Protectora.objects.all()
    return render(
        request,
        "animales/protectoras.html",
        {"protectoras": protectoras}
    )


def lista_colaboradores(request):
    colaboradores = Colaborador.objects.all()
    return render(
        request,
        "animales/colaboradores.html",
        {"colaboradores": colaboradores}
    )

def inicio(request):
    return render(request, "animales/inicio.html")
