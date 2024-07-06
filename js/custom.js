document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('evaluacionForm').addEventListener('submit', function(e) {
      e.preventDefault();

      // Validar campos de nombre y email
      let nombre = document.getElementById('nombre').value.trim();
      let email = document.getElementById('email').value.trim();
      
      if (nombre === '') {
          alert('El nombre es obligatorio.');
          return;
      }
      
      if (email === '') {
          alert('El correo es obligatorio.');
          return;
      }

      // Validar que el email no sea gratuito
      const correoGratuitoDominios = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];
      let emailDominio = email.split('@')[1];
      
      if (correoGratuitoDominios.includes(emailDominio)) {
          alert('Por favor, utiliza un correo corporativo.');
          return;
      }

      // Sumamos los valores de las preguntas
      let total = 0;
      let preguntas = document.querySelectorAll('#evaluacionForm input[type="radio"]:checked');
      preguntas.forEach(function(pregunta) {
          total += parseInt(pregunta.value);
      });

      // Determinamos el resultado
      let resultado;
      if (total >= 40) {
          resultado = "Alto";
      } else if (total >= 20) {
          resultado = "Medio";
      } else {
          resultado = "Bajo";
      }

      // Mostrar el resultado y ocultar el formulario
      document.getElementById('evaluacionForm').style.display = 'none';
      let resultadoDiv = document.getElementById('resultado');
      resultadoDiv.style.display = 'block';
      
      if (resultado === "Alto") {
          document.getElementById('alto').style.display = 'block';
      } else if (resultado === "Medio") {
          document.getElementById('medio').style.display = 'block';
      } else {
          document.getElementById('bajo').style.display = 'block';
      }

      // Enviar datos al servidor
      let data = {
          nombre: nombre,
          email: email,
          resultado: resultado,
          total: total
      };

      fetch('/wp-admin/admin-ajax.php?action=registrar_evaluacion', {
          method: 'POST',
          body: JSON.stringify(data),
          headers: {
              'Content-Type': 'application/json'
          }
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log('Evaluación registrada exitosamente.');
          } else {
              console.log('Error al registrar la evaluación:', data.message);
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
  });
});
