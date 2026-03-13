<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <div class="w3-container">
      <h2 class="w3-center w3-margin-top" style="color:#871521; font-weight:bold;">GURE TALDEAK</h2>
      
      <xsl:for-each select="Federazioa/TaldeGuztiak/Talde">
        <div class="w3-card-4 w3-margin w3-white w3-round-large">
          <header class="w3-container w3-padding" style="background-color:#871521; color:white; border-radius: 8px 8px 0 0;">
            <h3><xsl:value-of select="Izena"/></h3>
          </header>

          <div class="w3-container w3-padding">
            <div class="w3-row">
              <div class="w3-col m3 w3-center">
                <img src="irudiak/eskutua/{Ezkutua}.png" style="width:120px" class="w3-margin"/>
                <p><b>Pabellón:</b><br/><xsl:value-of select="Futbol_zelaia"/></p>
              </div>
              <div class="w3-col m9">
                <h4 class="w3-border-bottom">Plantilla</h4>
                <table class="w3-table w3-striped w3-bordered">
                  <thead>
                    <tr style="background-color:#f1f1f1">
                      <th>Dorsal</th>
                      <th>Nombre</th>
                      <th>Posición</th>
                    </tr>
                  </thead>
                  <tbody>
                    <xsl:for-each select="Jokalariak/Jokalari">
                      <tr>
                        <td><xsl:value-of select="@dortsala"/></td>
                        <td><xsl:value-of select="Izena"/> <xsl:value-of select="Abizena"/></td>
                        <td><xsl:value-of select="Posizioa"/></td>
                      </tr>
                    </xsl:for-each>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </xsl:for-each>
    </div>
  </xsl:template>
</xsl:stylesheet>