<?php 
    /* Template Name: formulario */ 
?>
<?php get_header()?>
     <!-- contenido principal -->
  <div class="grid-container">
    <div class="grid-x grid-padding-x align-center-middle">
      <form action="" id="evaluacionForm">
        <div class="large-10 cell formulario" id="formulario">
          <h2 class="text-center">Evaluación Ley Karin</h2>
          <p>La nueva Ley Karin (Ley 21643) en Chile, que entrará en vigor el 1 de agosto de 2024, introduce medidas significativas para prevenir, investigar y sancionar el acoso laboral, sexual y la violencia en el trabajo. Esta ley modifica el Código del Trabajo y otros cuerpos legales, estableciendo protocolos específicos y obligatorios para las empresas.
          Conoce el nivel de preparación y cumplimiento de tu organización respondiendo las siguientes preguntas.</p>
          <div id="preguntas">
            <fieldset class="large-5 cell">
              <legend>1. ¿La empresa ha elaborado y puesto a disposición un protocolo de prevención del acoso laboral,
                sexual y la violencia en el trabajo, así como la actualización en su reglamento interno?</legend>
              <input type="radio" name="preg1" value="3" id="resp-1a" required><label for="resp-1a">a) Si,
                completamente</label>
              <input type="radio" name="preg1" value="2" id="resp-1b"><label for="resp-1b">b) Parcialmente</label>
              <input type="radio" name="preg1" value="1" id="resp-1c"><label for="resp-1c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>2. ¿El protocolo de prevención incluye la identificación de peligros y la evaluación de riesgos
                psicosociales con perspectiva de género y fue incluido en la matriz de riesgos correspondiente?</legend>
              <input type="radio" name="preg2" value="3" id="resp-2a" required><label for="resp-2a">a) Si</label>
              <input type="radio" name="preg2" value="1" id="resp-2b"><label for="resp-2b">b) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>3. ¿Se han establecido medidas específicas para prevenir y controlar los riesgos identificados?
              </legend>
              <input type="radio" name="preg3" value="3" id="resp-3a" required><label for="resp-3a">a) Si, con objetivos
                medibles</label>
              <input type="radio" name="preg3" value="2" id="resp-3b"><label for="resp-3b">b) Parcialmente</label>
              <input type="radio" name="preg3" value="1" id="resp-3c"><label for="resp-3c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>4. ¿La empresa realiza capacitaciones para informar a los trabajadores sobre los riesgos
                psicosociales, las medidas de prevención y protección correspondientes?</legend>
              <input type="radio" name="preg4" value="3" id="resp-4a" required><label for="resp-4a">a) Si,
                regularmente</label>
              <input type="radio" name="preg4" value="2" id="resp-4b"><label for="resp-4b">b) Ocacionalmente</label>
              <input type="radio" name="preg4" value="1" id="resp-4c"><label for="resp-4c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>5. ¿Existen mecanismos para la protección de la privacidad y honra de los involucrados en los
                procedimientos de investigación??</legend>
              <input type="radio" name="preg5" value="3" id="resp-5a" required><label for="resp-5a">a) Si</label>
              <input type="radio" name="preg5" value="2" id="resp-5b"><label for="resp-5b">b) Parcialmente</label>
              <input type="radio" name="preg5" value="1" id="resp-5c"><label for="resp-5c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>6. ¿La empresa ha designado a un responsable o comité para la implementación del protocolo de
                prevención en cada una de sus instalaciones?</legend>
              <input type="radio" name="preg6" value="3" id="resp-6a" required><label for="resp-6a">a) Si</label>
              <input type="radio" name="preg6" value="2" id="resp-6b"><label for="resp-6b">b) Solo en algunas</label>
              <input type="radio" name="preg6" value="1" id="resp-6c"><label for="resp-6c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>7. ¿Se dispone de protocolos de control y seguimiento continuo para evaluar la eficacia de las
                medidas de prevención y su mejoramiento?</legend>
              <input type="radio" name="preg7" value="3" id="resp-7a" required><label for="resp-7a">a) Si</label>
              <input type="radio" name="preg7" value="1" id="resp-7c"><label for="resp-7c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>8. ¿Se han establecido canales accesibles y seguros para la denuncia de acoso laboral, sexual y
                violencia en el trabajo para todas sus instalaciones, oficinas y/o sucursales?</legend>
              <input type="radio" name="preg8" value="3" id="resp-8a" required><label for="resp-8a">a) Si</label>
              <input type="radio" name="preg8" value="2" id="resp-8b"><label for="resp-8b">b) Solo en algunas</label>
              <input type="radio" name="preg8" value="1" id="resp-8c"><label for="resp-8c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>9. ¿La empresa informa semestralmente sobre los canales de denuncia y las instancias estatales
                disponibles para los trabajadores, así como otras vías legales que pudiesen abordarse?</legend>
              <input type="radio" name="preg9" value="3" id="resp-9a" required><label for="resp-9a">a) Si</label>
              <input type="radio" name="preg9" value="2" id="resp-9b"><label for="resp-9b">b) Parcialmente</label>
              <input type="radio" name="preg9" value="1" id="resp-9c"><label for="resp-9c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>10. ¿Se implementan medidas inmediatas de resguardo para los involucrados tras una denuncia de acoso
                o violencia?</legend>
              <input type="radio" name="preg10" value="3" id="resp-10a" required><label for="resp-10a">a) Si</label>
              <input type="radio" name="preg10" value="1" id="resp-10c"><label for="resp-10c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>11. ¿Se han realizado campañas de sensibilización sobre acoso laboral, sexual y violencia en el
                trabajo?</legend>
              <input type="radio" name="preg11" value="3" id="resp-11a" required><label for="resp-11a">a) Si, con
                regularidad</label>
              <input type="radio" name="preg11" value="2" id="resp-11b"><label for="resp-11b">b) Ocasionalmente</label>
              <input type="radio" name="preg11" value="1" id="resp-11c"><label for="resp-11c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>12. ¿La empresa ha adoptado medidas para la reubicación o protección temporal de la víctima durante
                la investigación?</legend>
              <input type="radio" name="preg12" value="3" id="resp-12a" required><label for="resp-12a">a) Si</label>
              <input type="radio" name="preg12" value="1" id="resp-12c"><label for="resp-12c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>13. ¿Existen políticas claras y difundidas sobre las sanciones aplicables en caso de acoso laboral,
                sexual y violencia?</legend>
              <input type="radio" name="preg13" value="3" id="resp-13a" required><label for="resp-13a">a) Si</label>
              <input type="radio" name="preg13" value="1" id="resp-13c"><label for="resp-13c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>14. ¿Los trabajadores reciben formación sobre sus derechos y responsabilidades en cuanto a la
                prevención de los diferentes tipos de acoso y sobre la violencia en el trabajo?</legend>
              <input type="radio" name="preg14" value="3" id="resp-14a" required><label for="resp-14a">a) Si</label>
              <input type="radio" name="preg14" value="1" id="resp-14c"><label for="resp-14c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>15. ¿Se realiza difusión de las gestiones realizadas, del avance y mejoras implementadas para el
                conocimiento de todos los trabajadores en sus diferentes instalaciones?</legend>
              <input type="radio" name="preg15" value="3" id="resp-15a" required><label for="resp-15a">a) Si, de manera
                estructurada</label>
              <input type="radio" name="preg15" value="2" id="resp-15b"><label for="resp-15b">b) Parcialmente</label>
              <input type="radio" name="preg15" value="1" id="resp-15c"><label for="resp-15c">c) No</label>
            </fieldset>
            <fieldset class="large-5 cell">
              <legend>16. ¿La empresa ha preparado a sus líderes para identificar tempranamente este tipo de casos y saber
                cómo abordarlos adecuadamente con perspectiva de género?</legend>
              <input type="radio" name="preg16" value="3" id="resp-16a" required><label for="resp-16a">a) Si</label>
              <input type="radio" name="preg16" value="1" id="resp-16c"><label for="resp-16c">c) No</label>
            </fieldset>
          </div>
          <hr>
          <p>Para ver los resultados de la evaluacion ingresa tu nombre y correo de empresa. Enviaremos la informacion a
            tu correo.</p>
          <div class="grid-x grid-padding-x">
            <div class="large-6 cell">
              <label for="nombre">Nombre:
                <input type="text" name="nombre" value="" id="nombre" placeholder="Nombre" required />
              </label>
              <label for="email">Correo:
                <input type="email" name="email" id="email" value="" required />
              </label>
            </div>
            <div class=" large-12 cell">
              <button type="submit" class="button">Revisar resultados</button>
            </div>
          </div>

        </div>
      </form>
      <div id="resultado" style="display: none;">
        <div id="alto" style="display: none;">
            <h2>Resultado Alto</h2>
            <p>Felicidades, su empresa tiene un alto cumplimiento de la Ley Karin.</p>
        </div>
        <div id="medio" style="display: none;">
            <h2>Resultado Medio</h2>
            <p>Su empresa tiene un cumplimiento medio de la Ley Karin, se recomienda mejorar en algunas áreas.</p>
        </div>
        <div id="bajo" style="display: none;">
            <h2>Resultado Bajo</h2>
            <p>Su empresa tiene un bajo cumplimiento de la Ley Karin, se recomienda implementar medidas urgentes.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- fin contenido principal -->
   <?php get_footer()?>