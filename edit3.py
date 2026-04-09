import sys
import os

filepath = 'application/views/v_ev.php'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# For lines 716, 718, 722, 724
content = content.replace('{$format_unit} (Mandiri)<br>', '{$format_unit} Jawaban Unit<br>')
content = content.replace('{$format} (Evaluasi)', '{$format} Jawaban Evaluator')
content = content.replace('{$format_unitp}% (Mandiri)<br>', '{$format_unitp}% Jawaban Unit<br>')
content = content.replace('{$format}% (Evaluasi)', '{$format}% Jawaban Evaluator')

# For Predikat unit (Mandiri)
content = content.replace('E (Mandiri)', 'E Jawaban Unit')
content = content.replace('D (Mandiri)', 'D Jawaban Unit')
content = content.replace('C (Mandiri)', 'C Jawaban Unit')
content = content.replace('CC (Mandiri)', 'CC Jawaban Unit')
content = content.replace('B (Mandiri)', 'B Jawaban Unit')
content = content.replace('BB (Mandiri)', 'BB Jawaban Unit')
content = content.replace('A (Mandiri)', 'A Jawaban Unit')
content = content.replace('AA (Mandiri)', 'AA Jawaban Unit')

# For Predikat evaluasi (Evaluasi)
content = content.replace('E (Evaluasi)', 'E Jawaban Evaluator')
content = content.replace('D (Evaluasi)', 'D Jawaban Evaluator')
content = content.replace('C (Evaluasi)', 'C Jawaban Evaluator')
content = content.replace('CC (Evaluasi)', 'CC Jawaban Evaluator')
content = content.replace('B (Evaluasi)', 'B Jawaban Evaluator')
content = content.replace('BB (Evaluasi)', 'BB Jawaban Evaluator')
content = content.replace('A (Evaluasi)', 'A Jawaban Evaluator')
content = content.replace('AA (Evaluasi)', 'AA Jawaban Evaluator')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Done. Deleting self.")
os.remove(__file__)
