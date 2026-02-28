<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpiritualGiftsSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            1 => 'Disfruto ayudar de forma práctica a personas con necesidades puntuales.',
            2 => 'Me resulta natural animar a otros cuando están desmotivados.',
            3 => 'Puedo organizar tareas y personas para alcanzar objetivos comunes.',
            4 => 'Me gusta profundizar y explicar con claridad ideas bíblicas o espirituales.',
            5 => 'Tengo facilidad para detectar necesidades de cuidado pastoral.',
            6 => 'Prefiero colaborar detrás de escena para que todo salga bien.',
            7 => 'Me entusiasma iniciar proyectos nuevos con visión y empuje.',
            8 => 'Suelo tomar decisiones sabias en momentos de incertidumbre.',
            9 => 'Siento compasión por personas heridas y busco acompañarlas.',
            10 => 'Disfruto compartir recursos para apoyar causas valiosas.',
            11 => 'Puedo motivar a un equipo para servir con excelencia.',
            12 => 'Me es fácil enseñar paso a paso a otras personas.',
            13 => 'Percibo cuándo una persona necesita dirección y contención.',
            14 => 'Me emociona servir con hospitalidad y calidez.',
            15 => 'Tengo iniciativa para abrir caminos en contextos desafiantes.',
            16 => 'Me gusta evaluar situaciones complejas y proponer soluciones.',
            17 => 'Acompaño a otros con empatía en momentos de dolor.',
            18 => 'Con gusto aporto económicamente cuando hay una necesidad real.',
            19 => 'Me siento cómodo coordinando voluntarios y actividades.',
            20 => 'Puedo explicar temas difíciles de manera simple y ordenada.',
            21 => 'Busco activamente restaurar a quien se ha desviado.',
            22 => 'Me satisface apoyar tareas operativas sin reconocimiento público.',
            23 => 'Disfruto levantar nuevos ministerios o iniciativas.',
            24 => 'Suelo aconsejar con equilibrio y sentido práctico.',
            25 => 'Me conmueve profundamente el sufrimiento de otros.',
            26 => 'Soy generoso incluso cuando dar implica sacrificio personal.',
            27 => 'Tengo habilidad para liderar reuniones y procesos.',
            28 => 'Me gusta capacitar a otros para que crezcan en su llamado.',
            29 => 'Acompaño con paciencia a personas en su desarrollo espiritual.',
            30 => 'Encuentro alegría al servir en tareas simples y constantes.',
            31 => 'Me adapto rápido a cambios y retos de misión.',
            32 => 'Identifico patrones y riesgos antes de tomar una decisión.',
            33 => 'Busco activamente consolar y aliviar a quien está afligido.',
            34 => 'Me siento responsable de administrar bien mis recursos para dar más.',
            35 => 'Disfruto delegar y dar seguimiento a responsabilidades.',
            36 => 'Puedo crear materiales y dinámicas de aprendizaje efectivas.',
            37 => 'Me preocupa el bienestar integral de las personas a mi cargo.',
            38 => 'Sirvo con alegría aunque la tarea sea exigente o repetitiva.',
            39 => 'Me entusiasma anunciar buenas noticias en contextos nuevos.',
            40 => 'Suelo orientar con madurez ante conflictos relacionales.',
            41 => 'Soy sensible para escuchar y sostener emocionalmente.',
            42 => 'Me motiva financiar proyectos que transformen vidas.',
            43 => 'Puedo mantener enfoque y dirección cuando hay presión.',
            44 => 'Investigo y preparo con diligencia lo que voy a enseñar.',
            45 => 'Procuro guiar a otros hacia hábitos saludables y disciplina.',
            46 => 'Estoy disponible para servir cuando surge una urgencia.',
            47 => 'Me moviliza alcanzar personas fuera de mi círculo habitual.',
            48 => 'Soy buscado por otros cuando necesitan consejo prudente.',
            49 => 'Demuestro ternura y paciencia con quienes atraviesan crisis.',
            50 => 'Comparto recursos con libertad y sin esperar reconocimiento.',
            51 => 'Sé construir equipos que trabajan unidos y con propósito.',
            52 => 'Me apasiona ver a otros comprender y aplicar lo aprendido.',
            53 => 'Acompaño procesos de fe de largo plazo con compromiso.',
            54 => 'Sirvo fielmente en lo pequeño para sostener lo grande.',
            55 => 'Tomo la iniciativa para expandir el alcance de la misión.',
            56 => 'Puedo distinguir entre opciones buenas y mejores.',
            57 => 'Actúo con compasión concreta ante necesidades urgentes.',
            58 => 'Planifico mi presupuesto considerando generosidad intencional.',
            59 => 'Inspiro confianza cuando toca dirigir decisiones importantes.',
            60 => 'Tengo facilidad para estructurar contenidos formativos claros.',
        ];

        foreach ($questions as $number => $text) {
            Question::updateOrCreate(['number' => $number], ['text' => $text]);
        }

        $giftNames = [
            'Servicio', 'Exhortación', 'Administración', 'Enseñanza', 'Pastorado',
            'Ayuda', 'Evangelismo', 'Sabiduría', 'Misericordia', 'Generosidad',
            'Liderazgo', 'Discipulado', 'Acompañamiento', 'Hospitalidad', 'Misión',
            'Consejería', 'Compasión', 'Mayordomía', 'Dirección', 'Formación'
        ];

        foreach ($giftNames as $index => $name) {
            $gift = Gift::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );

            $start = ($index * 3) + 1;
            $questionIds = Question::query()
                ->whereBetween('number', [$start, $start + 2])
                ->pluck('id');

            $gift->questions()->sync($questionIds);
        }
    }
}
