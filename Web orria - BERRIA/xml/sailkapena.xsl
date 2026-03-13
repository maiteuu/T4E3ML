<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <table class="w3-table w3-striped w3-bordered sailkapenaTabla">
            <thead>
                <tr style="background-color: #871521; color: white;">
                    <th>Pos</th>
                    <th>Taldea</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PE</th>
                    <th>PP</th>
                    <th>Puntuak</th>
                </tr>
            </thead>
            <tbody>
                <xsl:for-each select="Sailkapena/Lerroa">
                    <tr>
                        <td><xsl:value-of select="position()"/></td>
                        <td>
                            <img src="irudiak/eskutua/{Ezkutua}.png" style="width:25px; margin-right:10px;"/>
                            <xsl:value-of select="Taldea"/>
                        </td>
                        <td><xsl:value-of select="PJ"/></td>
                        <td><xsl:value-of select="Irabaziak"/></td>
                        <td><xsl:value-of select="Berdinduak"/></td>
                        <td><xsl:value-of select="Galduak"/></td>
                        <td><strong><xsl:value-of select="Puntuak"/></strong></td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </xsl:template>
</xsl:stylesheet>