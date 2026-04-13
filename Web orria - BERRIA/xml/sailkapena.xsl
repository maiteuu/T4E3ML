<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">

<div class="w3-responsive w3-margin-bottom container-tabla-movil" 
     style="width: 95%; max-width: 750px; margin: 0 auto;">
            <div class="w3-card-4 w3-round-large w3-white"
                style="overflow: hidden; border: 1px solid #ddd;">

                <table class="w3-table w3-hoverable sailkapenaTaula" style="width: 100%;">
                    <thead>
                        <tr
                            style="background-color: #871521; color: white; text-transform: uppercase; font-size: 0.9em;">
                            <th class="w3-center w3-padding-16"
                                style="width: 60px; box-shadow: inset 5px 0 0 0 #871521;">Pos</th>
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
                                style="background-color: {$bgColor}; cursor: pointer;">
                                <td class="w3-center"
                                    style="vertical-align: middle; font-weight: bold; box-shadow: inset 5px 0 0 0 {$borderColor};">
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
                                <td class="w3-center"
                                    style="vertical-align: middle; color: #666; font-size: 0.9em;">
                                    <xsl:value-of select="PJ" />
                                </td>
                                <td class="w3-center"
                                    style="vertical-align: middle; color: #666; font-size: 0.9em;">
                                    <xsl:value-of select="Irabaziak" />
                                </td>
                                <td class="w3-center"
                                    style="vertical-align: middle; color: #666; font-size: 0.9em;">
                                    <xsl:value-of select="Berdinduak" />
                                </td>
                                <td class="w3-center"
                                    style="vertical-align: middle; color: #666; font-size: 0.9em;">
                                    <xsl:value-of select="Galduak" />
                                </td>
                                <td class="w3-center"
                                    style="vertical-align: middle; font-size: 1em; color: #871521; font-weight: 800;">
                                    <strong>
                                        <xsl:value-of select="Puntuak" />
                                    </strong>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
                <div id="seccion-leienda-unica">
                    <div class="item-leienda">
                        <span class="puntu-leienda"
                            style="background-color: #fbc02d !important;">&#160;</span>
                        <span class="textu-leienda">Txapelduna</span>
                    </div>

                    <div class="item-leienda">
                        <span class="puntu-leienda"
                            style="background-color: #2196f3 !important;">&#160;</span>
                        <span class="textu-leienda">Europako Kopa</span>
                    </div>

                    <div class="item-leienda">
                        <span class="puntu-leienda"
                            style="background-color: #f44336 !important;">&#160;</span>
                        <span class="textu-leienda">Jaitsiera</span>
                    </div>
                </div>
            </div>
        </div>

    </xsl:template>
</xsl:stylesheet>