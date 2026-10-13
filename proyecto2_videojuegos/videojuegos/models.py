from django.db import models


class Videojuego(models.Model):
    titulo = models.CharField(max_length=100)
    plataforma = models.CharField(max_length=50)
    precio = models.DecimalField(max_digits=7, decimal_places=2)

    def __str__(self):
        return self.titulo


class Cliente(models.Model):
    nombre = models.CharField(max_length=100)
    correo = models.EmailField()
    fecha_registro = models.DateTimeField()

    def __str__(self):
        return self.nombre


class Pedido(models.Model):
    videojuego = models.ForeignKey(
        Videojuego,
        on_delete=models.CASCADE
    )
    cliente = models.ForeignKey(
        Cliente,
        on_delete=models.CASCADE
    )
    fecha_pedido = models.DateTimeField()

    def __str__(self):
        return f"{self.videojuego.titulo} - {self.cliente.nombre}"
