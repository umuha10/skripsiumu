from flask import Flask, jsonify
from flask_cors import CORS
import numpy as np
import pandas as pd

app = Flask(__name__)
CORS(app)

def normalisasi_matrik(C):
    X = 0
    for i in C:
        X += i**2
    
    return np.sqrt(X)

def predict_model():
    kriteria = ["tidak dapat bansos", "kehilangan pekerjaan", "penyakit kronis"]
    rule = ["0,1", "0,2", "1,2"]
    skor = [5, 7, 2]

    index_rule = 0
    myRule = rule[index_rule]

    tabel_matrik = []

    for i in range(len(kriteria)): #baris
        temp = []
        for j in range(len(kriteria)): #kolom
            if i == j:
                temp.append(1)
            else:
                r = myRule.split(",")
                if i == int(r[0]) and j == int(r[1]):
                    nilai = skor[index_rule]
                    temp.append(nilai)
                    
                    index_rule += 1
                    
                    if index_rule < len(rule):
                        myRule = rule[index_rule]
                else:
                    nilai = 1 / tabel_matrik[j][i]
                    temp.append(nilai)
                    
        tabel_matrik.append(temp)
        print()

    tabel_matrik_df = pd.DataFrame(tabel_matrik, columns=kriteria)

    list_jumlah = list()

    for i in range(len(tabel_matrik)):
        total = 0
        for j in range(len(tabel_matrik)):
            total += tabel_matrik[j][i]
            
        list_jumlah.append(total)

    tabel_matrik_2 = tabel_matrik.copy()
    tabel_matrik_2.append(list_jumlah)

    tabel_matrik_df2 = pd.DataFrame(tabel_matrik_2, columns=kriteria)

    tabel_nilai_eigen = []

    for i in range(len(tabel_matrik)):
        temp = []
        for j in range(len(tabel_matrik)):
            eigen = tabel_matrik[i][j] / list_jumlah[j]
            temp.append(eigen)
        tabel_nilai_eigen.append(temp)

    list_jumlah_eigen = []

    for i in range(len(tabel_nilai_eigen)):
        total = 0
        for j in range(len(tabel_nilai_eigen)):
            total += tabel_nilai_eigen[i][j]
        list_jumlah_eigen.append(total)

    rerata_list_jumlah_eigen = list()

    for i in range(len(list_jumlah_eigen)):
        rerata = list_jumlah_eigen[i] / len(tabel_nilai_eigen)
        rerata_list_jumlah_eigen.append(rerata)

    tabel_nilai_prioritas_relatif = list()

    for i in range(len(tabel_matrik)):
        temp = list()
        for j in range(len(tabel_matrik)):
            nilai_prioritas_relatif = tabel_matrik[i][j] * rerata_list_jumlah_eigen[j]
            temp.append(nilai_prioritas_relatif)
        
        tabel_nilai_prioritas_relatif.append(temp)

    list_jumlah_prioritas_relatif = list()

    for i in range(len(tabel_nilai_prioritas_relatif)):
        total = 0
        for j in range(len(tabel_nilai_prioritas_relatif)):
            total += tabel_nilai_prioritas_relatif[i][j]
        list_jumlah_prioritas_relatif.append(total)

    rerata_prioritas_dari_eigen = list()
    total_prioritas_dari_eigen = 0

    for i in range(len(list_jumlah_prioritas_relatif)):
        rerata = list_jumlah_prioritas_relatif[i] / rerata_list_jumlah_eigen[i]
        total_prioritas_dari_eigen += rerata
        rerata_prioritas_dari_eigen.append(rerata)

    lambda_max = total_prioritas_dari_eigen / len(rerata_prioritas_dari_eigen)

    CI = (lambda_max - len(kriteria)) / (len(kriteria) - 1)

    IR = 0.58
    CR = CI / IR

    bobot_topsis = rerata_list_jumlah_eigen

    dataset = pd.read_excel("dataset/Dataset.xlsx")
    dataset.columns = ['Alternatif', "C1", "C2", "C3"]

    # tabel_matriks_nilai_alternatif = list()

    tb_matriks_nilai_alternatif_df = dataset.copy()

    C1 = tb_matriks_nilai_alternatif_df.C1
    X1 = normalisasi_matrik(C1)

    C2 = tb_matriks_nilai_alternatif_df.C2
    X2 = normalisasi_matrik(C2)

    C3 = tb_matriks_nilai_alternatif_df.C3
    X3 = normalisasi_matrik(C3)

    Xs = list()

    Xs.append(X1)
    Xs.append(X2)
    Xs.append(X3)

    prepare_tabel_normalisasi = []

    kriteria = ["C1", "C2", "C3"]
    for k in kriteria:
        temp = list()
        a = tb_matriks_nilai_alternatif_df[k]
        for b in a:
            temp.append(b)
        prepare_tabel_normalisasi.append(temp)

    tabel_matriks_normalisasi = list()

    for i in range(len(prepare_tabel_normalisasi)):
        temp = list()
        for j in range(len(prepare_tabel_normalisasi[0])):
            normalisasi = prepare_tabel_normalisasi[i][j] / Xs[i]
            temp.append(normalisasi)
        tabel_matriks_normalisasi.append(temp)

    tabel_matriks_normalisasi_bobot = []

    for i in range(len(tabel_matriks_normalisasi)):
        temp = []
        for j in range(len(prepare_tabel_normalisasi[0])):
            normalisasi3 = tabel_matriks_normalisasi[i][j] * bobot_topsis[i]
            temp.append(normalisasi3)
        tabel_matriks_normalisasi_bobot.append(temp)

    # isi list berupa nilai maksimum dan mininimum per kriteria
    # tiap anggota list adalah kriteria
    A_plus = []
    A_min = []

    df_tabel_matriks_normalisasi_bobot = pd.DataFrame(tabel_matriks_normalisasi_bobot)

    for i in range(len(tabel_matriks_normalisasi_bobot)):
    #     for j in range(len(prepare_tabel_normalisasi)):
        nilai = df_tabel_matriks_normalisasi_bobot.loc[i]
        nilai = np.array(nilai)
        A_plus.append(np.max(nilai))
        A_min.append(np.min(nilai))

    # isi list berupa nilai maksimum dan minimum per alternatif
    # tiap anggota list adalah alternatif
    D_plus = []
    D_min = []

    for i in range(len(tabel_matriks_normalisasi_bobot[0])):
        temp_D_plus = 0
        temp_D_min = 0
        for j in range(len(tabel_matriks_normalisasi_bobot)):
            temp_D_plus += ((tabel_matriks_normalisasi_bobot[j][i] - A_plus[j]) ** 2)
            temp_D_min += ((tabel_matriks_normalisasi_bobot[j][i] - A_min[j]) ** 2)
        D_plus.append(np.sqrt(temp_D_plus))
        D_min.append(np.sqrt(temp_D_min))

    nilai_preferensi = []

    for i in range(len(tabel_matriks_normalisasi[0])):
        nilai = D_min[i] / (D_min[i] + D_plus[i])
        nilai_preferensi.append(nilai)

    ranking = {}

    for i in range(len(nilai_preferensi)):
        ranking[i] = nilai_preferensi[i]

    sorted_ranking = dict(sorted(ranking.items(),key= lambda x:x[1], reverse=True))

    return sorted_ranking

@app.route('/calculate', methods=['GET'])
def index():
    ranking = predict_model()

    data = {"data": str(ranking)}

    print(data)

    return jsonify(data), 200

if __name__ == "__main__":
    app.run()