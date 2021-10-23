from flask import Flask, jsonify, request
from flask_cors import CORS
import numpy as np
import pandas as pd

# library for database connection
import pymysql.cursors

# ============================================================================
#                                 DATABASE
# ============================================================================
#   Database Configuration
#
DB_SERVER = "localhost"
DB_USERNAME = "root"
DB_PASSWORD = ""
DB_NAME = "umu_ahp_topsis"

conn = cursor = None

def open_DB():
    global conn, cursor
    
    conn = pymysql.connect(host=DB_SERVER, user=DB_USERNAME, password=DB_PASSWORD, database=DB_NAME)
    cursor = conn.cursor()

def close_DB():
    global conn, cursor
    
    conn.close()
    cursor.close()


# ============================================================================
#                                 KONFIGURASI
# ============================================================================

app = Flask(__name__)
CORS(app)

def normalisasi_matrik(C):
    X = 0
    for i in C:
        X += int(i)**2
    
    return np.sqrt(X)

def predict_model(dataset):
    open_DB()

    # kriteria = ["tidak dapat bansos", "kehilangan pekerjaan", "penyakit kronis"]
    kriteria = []

    sql = "SELECT * FROM kriteria";
    cursor.execute(sql)
    results = cursor.fetchall()

    # print(results)
    for r in results:
        # print(r[2])
        kriteria.append(r[2])

    total_kriteria = len(kriteria)

    rule = []

    if total_kriteria > 0:
        for baris in range(total_kriteria):
            for kolom in range(total_kriteria):
                if baris < kolom:
                    text_baris = str(baris)
                    text_kolom = str(kolom)
                    rule.append(text_baris + ',' + text_kolom)

    # rule = ["0,1", "0,2", "1,2"]
    skor = [5, 7, 1] #minta kejelasan nanti

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
        # print()

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

    # dataset = pd.read_excel("dataset/Dataset.xlsx")
    # dataset.columns = ['Alternatif', "C1", "C2", "C3"]
    columns = ['Alternatif']
    kriteria = []
    
    for tk in range(total_kriteria):
        temp_col = 'C' + str(tk+1)
        kriteria.append(temp_col)
        columns.append(temp_col)

    dataset.columns = columns
    # tabel_matriks_nilai_alternatif = list()

    # print(dataset)

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

    # kriteria = ["C1", "C2", "C3"] # dipindah ke atas
    for k in kriteria:
        temp = list()
        a = tb_matriks_nilai_alternatif_df[k]
        for b in a:
            temp.append(int(b))
        prepare_tabel_normalisasi.append(temp)

    tabel_matriks_normalisasi = list()

    for i in range(len(prepare_tabel_normalisasi)):
        temp = list()
        for j in range(len(prepare_tabel_normalisasi[0])):
            try:
                normalisasi = prepare_tabel_normalisasi[i][j] / Xs[i]
            except:
                normalisasi = 0
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

@app.route('/calculate', methods=['POST', 'GET'])
def index():

    # print(request.json)
    json_data = request.json

    dataset = []
    nama = []

    for jd in json_data:
        nama.append(jd['no_kk'])
        dataset.append([jd['nama'], jd['bansos_diterima'], jd['bekerja'], jd['riwayat_penyakit']])

    dataset = pd.DataFrame(dataset)

    ranking = predict_model(dataset)

    latest_ranking = {}

    r = 1
    for d in ranking:
        latest_ranking[str(d)] = {'KK': nama[d], 'ranking': r}
        r += 1

    latest_ranking = dict(latest_ranking)

    # print(ranking)
    # print(latest_ranking)

    data = {"data": str(latest_ranking)}

    return jsonify(data), 200

if __name__ == "__main__":
    app.run()