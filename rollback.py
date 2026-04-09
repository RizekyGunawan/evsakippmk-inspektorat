import os

filepath = r'application\views\v_ev.php'

with open(filepath, 'r', encoding='utf-8') as f:
    lines = f.readlines()

replacement_text = """                                  <thead class="table-dark">
                                    <?php foreach ($sumkom as $sumk): ?>
                                      <tr class="table" data-widget="expandable-table" aria-expanded="false">
                                        <td colspan="2">
                                          <i class="expandable-table-caret "></i>
                                          NILAI AKUNTABILITAS KINERJA
                                        </td>
                                        <td class="text-center align-middle"><?php echo $sumk['sumbobot']; ?></td>
                                        <td class="text-center align-middle">
                                          <?php $format_unit = number_format((float) $sumk['sumnilaiunit'], 2, ",", ".");
                                          echo "{$format_unit} Jawaban Unit<br>";
                                          $format = number_format((float) $sumk['sumnilaik'], 2, ",", ".");
                                          echo "{$format} Jawaban Evaluator"; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                          <?php $format_unitp = number_format((float) $sumk['sumnilaiunitpersen'], 2, ",", ".");
                                          echo "{$format_unitp}% Jawaban Unit<br>";
                                          $format_p = number_format((float) $sumk['sumnilaikpersen'], 2, ",", ".");
                                          echo "{$format_p}% Jawaban Evaluator"; ?>
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  </thead>
                                  <?php foreach ($sumkom as $sumk): ?>
                                    <tr class="table" data-widget="expandable-table" aria-expanded="false">
                                      <td colspan="3">
                                        <i class="expandable-table-caret "></i>
                                        PREDIKAT
                                      </td>

                                      <td <?php if ($this->session->userdata('id_unit') == "") {
                                        echo "hidden";
                                      } else {
                                        echo "";
                                      }
                                      ; ?> class="text-center align-middle">
                                        <?php $format_unit = floatval(str_replace(',', '.', $sumk['sumnilaiunit']));
                                        if ($format_unit == 0) {
                                          echo "E Jawaban Unit";
                                        } elseif ($format_unit > 0.01 && $format_unit <= 30.00) {
                                          echo "D Jawaban Unit";
                                        } elseif ($format_unit > 30.01 && $format_unit <= 50.00) {
                                          echo "C Jawaban Unit";
                                        } elseif ($format_unit >= 50.01 && $format_unit <= 60.00) {
                                          echo "CC Jawaban Unit";
                                        } elseif ($format_unit >= 60.01 && $format_unit <= 70.00) {
                                          echo "B Jawaban Unit";
                                        } elseif ($format_unit >= 70.01 && $format_unit <= 80.00) {
                                          echo "BB Jawaban Unit";
                                        } elseif ($format_unit >= 80.01 && $format_unit <= 90.00) {
                                          echo "A Jawaban Unit";
                                        } elseif ($format_unit >= 90.01 && $format_unit <= 100) {
                                          echo "AA Jawaban Unit";
                                        } else {
                                          echo "-";
                                        }
                                        ; ?>
                                      </td>
                                      <td class="text-center align-middle">
                                        <?php $format = floatval(str_replace(',', '.', $sumk['sumnilaik']));
                                        if ($format == 0) {
                                          echo "E Jawaban Evaluator";
                                        } elseif ($format > 0.01 && $format <= 30.00) {
                                          echo "D Jawaban Evaluator";
                                        } elseif ($format > 30.01 && $format <= 50.00) {
                                          echo "C Jawaban Evaluator";
                                        } elseif ($format >= 50.01 && $format <= 60.00) {
                                          echo "CC Jawaban Evaluator";
                                        } elseif ($format >= 60.01 && $format <= 70.00) {
                                          echo "B Jawaban Evaluator";
                                        } elseif ($format >= 70.01 && $format <= 80.00) {
                                          echo "BB Jawaban Evaluator";
                                        } elseif ($format >= 80.01 && $format <= 90.00) {
                                          echo "A Jawaban Evaluator";
                                        } elseif ($format >= 90.01 && $format <= 100) {
                                          echo "AA Jawaban Evaluator";
                                        } else {
                                          echo "-";
                                        }
                                        ; ?>
                                      </td>

                                    </tr>
                                  <?php endforeach; ?>
"""

# Find starting boundary (line ~706)
start_idx = -1
for i, line in enumerate(lines):
    if '<thead class="table-dark">' in line and i > 650:
        start_idx = i
        break

# Find ending boundary (line ~912)
end_idx = -1
for i in range(start_idx, len(lines)):
    if '                                  <?php endforeach; ?>' in lines[i]:
        # we want to cover the SECOND endforeach
        pass
    if '<?php endforeach; ?>' in lines[i] and i > 900:
        end_idx = i
        break

print(f"Start index: {start_idx}, End index: {end_idx}")

new_lines = lines[:start_idx] + [replacement_text] + lines[end_idx+1:]

with open(filepath, 'w', encoding='utf-8') as f:
    f.writelines(new_lines)
    
print("Rollback complete.")
os.remove(__file__)
