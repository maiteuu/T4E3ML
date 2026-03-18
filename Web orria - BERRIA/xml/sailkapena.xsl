<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">

        <div class="w3-responsive w3-margin-bottom"
            style="width: 95%; max-width: 750px; margin: 0 auto;">
            <div class="w3-card-4 w3-round-large w3-white"
                style="overflow: hidden; border: 1px solid #ddd;">

                <table class="w3-table w3-hoverable sailkapenaTabla" style="width: 100%;">
                    <thead>
                        <tr
                            style="background-color: #871521; color: white; text-transform: uppercase; font-size: 0.9em;">
                            <th class="w3-center w3-padding-16" style="width: 60px;">Pos</th>
                            <th class="w3-padding-16" style="text-align: left; padding-left: 15px;">
        Taldea</th>
                            <th class="w3-center w3-padding-16">PJ</th>
                            <th class="w3-center w3-padding-16">PG</th>
                            <th class="w3-center w3-padding-16">PE</th>
                            <th class="w3-center w3-padding-16">PP</th>
                            <th class="w3-center w3-padding-16">Puntuak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <xsl:for-each select="Sailkapena/Lerroa">

                            <xsl:variable name="pos" select="position()" />
                            <xsl:variable
                                name="total" select="last()" />
                            
                            <xsl:variable name="bgColor">
                                <xsl:choose>
                                    <xsl:when test="$pos = 1">#fffde7</xsl:when>
                                    <xsl:when test="$pos = 2">#e3f2fd</xsl:when>
                                    <xsl:when test="$pos &gt;= $total - 1">#ffebee</xsl:when>
                                    <xsl:otherwise>transparent</xsl:otherwise>
                                </xsl:choose>
                            </xsl:variable>

                            <xsl:variable
                                name="borderColor">
                                <xsl:choose>
                                    <xsl:when test="$pos = 1">#fbc02d</xsl:when>
                                    <xsl:when test="$pos = 2">#2196f3</xsl:when>
                                    <xsl:when test="$pos &gt;= $total - 1">#f44336</xsl:when>
                                    <xsl:otherwise>transparent</xsl:otherwise>
                                </xsl:choose>
                            </xsl:variable>

                            <tr
                                style="background-color: {$bgColor}; cursor: pointer; border-bottom: 1px solid #eee;">

                                <td class="w3-center"
                                    style="vertical-align: middle; font-weight: bold; border-left: 5px solid {$borderColor};">
                                    <xsl:value-of select="$pos" />
                                </td>

                                <td style="vertical-align: middle; padding-left: 15px;">
                                    <a href="taldeak.php?izena={Taldea}&amp;origen=sailkapena"
                                        style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px; font-weight: bold;">
                                        <img src="irudiak/eskutua/{Ezkutua}.png"
                                            style="width: 30px; height: 30px; object-fit: contain;" />
                                        <xsl:value-of select="Taldea" />
                                    </a>
                                </td>
                                <td class="w3-center" style="vertical-align: middle;">
                                    <xsl:value-of select="PJ" />
                                </td>
                                <td class="w3-center" style="vertical-align: middle;">
                                    <xsl:value-of select="Irabaziak" />
                                </td>
                                <td class="w3-center" style="vertical-align: middle;">
                                    <xsl:value-of select="Berdinduak" />
                                </td>
                                <td class="w3-center" style="vertical-align: middle;">
                                    <xsl:value-of select="Galduak" />
                                </td>
                                <td class="w3-center"
                                    style="vertical-align: middle; font-size: 1.1em; color: #871521;">
                                    <strong>
                                        <xsl:value-of select="Puntuak" />
                                    </strong>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>

<style>
                    .box-leyenda {
                        background-color: #fafafa;
                        border-top: 1px solid #eaeaea;
                        padding: 10px 5px; /* Márgenes superior/inferior reducidos a la mitad */
                        text-align: center;
                        width: 100%;
                    }
                    .item-leyenda {
                        display: inline-block;
                        margin: 2px 12px; /* Márgenes laterales mucho más ajustados */
                        font-size: 0.85em; /* Texto un poco más pequeño y elegante */
                        font-weight: bold;
                        color: #666; /* Gris más suave */
                        white-space: nowrap; /* Sigue protegiendo contra el overlap */
                    }
                    .punto-leyenda {
                        font-size: 1.2em; /* Punto proporcionado al texto */
                        vertical-align: middle;
                        margin-right: 4px; /* Punto más pegado a la palabra */
                        line-height: 0;
                    }
                    .texto-leyenda {
                        vertical-align: middle;
                        text-transform: uppercase; /* Mayúsculas tipo web deportiva */
                        letter-spacing: 0.5px; /* Un poco de aire entre las letras */
                    }
                </style>

                <div class="box-leyenda">
                    
                    <div class="item-leyenda">
                        <span class="punto-leyenda" style="color: #fbc02d;">&#9679;</span>
                        <span class="texto-leyenda">Txapelduna</span>
                    </div>
                    
                    <div class="item-leyenda">
                        <span class="punto-leyenda" style="color: #2196f3;">&#9679;</span>
                        <span class="texto-leyenda">Europako Kopa</span>
                    </div>
                    
                    <div class="item-leyenda">
                        <span class="punto-leyenda" style="color: #f44336;">&#9679;</span>
                        <span class="texto-leyenda">Jaitsiera</span>
                    </div>

                </div>
            </div>
        </div>

    </xsl:template>
</xsl:stylesheet>