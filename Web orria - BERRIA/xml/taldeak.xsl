<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  
  <xsl:param name="taldeParam" select="''"/>
  <xsl:param name="nondikParam" select="''"/>

 <xsl:template match="/">
    <div class="orri-titulua-container">
      <h2 class="orri-titulua">GURE TALDEAK</h2>
      <span class="orri-marra"></span>
    </div>

    <div class="w3-container" style="display: flex; flex-wrap: wrap; align-items:center; flex-direction: column;">
      <xsl:choose>
        
        <xsl:when test="$taldeParam = ''">
          <div class="w3-row-padding w3-margin-top" style="width: 100%; max-width: 1200px; display: flex; flex-wrap: wrap; justify-content: center;">
            
            <xsl:for-each select="Federazioa/TaldeGuztiak/Talde">
              <div class="w3-col l3 m4 s6 w3-margin-bottom w3-center">
                
                <a href="taldeak.php?izena={Izena}" style="text-decoration: none; color: inherit;">
                  <div class="w3-card w3-white w3-padding-24 w3-round-large w3-hover-shadow" style="cursor: pointer; transition: 0.3s;">
                    <img src="irudiak/eskutua/{Ezkutua}.png" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 15px;" />
                    <h4 style="font-weight: bold; color: #871521; margin: 0; font-size: 1.2em;">
                      <xsl:value-of select="Izena" />
                    </h4>
                  </div>
                </a>
                
              </div>
            </xsl:for-each>
            
          </div>
        </xsl:when>

        <xsl:otherwise>
          
          <div class="w3-margin-bottom w3-margin-top">
            <xsl:choose>
              <xsl:when test="$origenParam = 'sailkapena'">
                <a href="sailkapena.php" class="w3-button w3-round-large w3-hover-red" style="background-color:#871521; color:white; text-decoration:none;">
                   Bueltatu (Sailkapena)
                </a>
              </xsl:when>
              <xsl:otherwise>
                <a href="taldeak.php" class="w3-button w3-round-large w3-hover-red" style="background-color:#871521; color:white; text-decoration:none;">
                   Bueltatu (Talde guztiak)
                </a>
              </xsl:otherwise>
            </xsl:choose>
          </div>

          <xsl:for-each select="Federazioa/TaldeGuztiak/Talde[Izena = $taldeParam]">
            <div class="w3-card-4 w3-margin-bottom w3-white w3-round-large w3-overflow-hidden" style="width: 80%; max-width: 1000px;">
              
              <header class="w3-container" style="background-color:#871521; color:white;">
                <h3 style="margin: 15px 0; display: flex; align-items: center;">
                  <img src="irudiak/eskutua/{Ezkutua}.png" style="width:100px; margin-right:20px; object-fit: contain;" />
                  <xsl:value-of select="Izena" />
                </h3>
              </header>

              <div class="w3-container w3-padding-24">
                <div class="w3-row" style="display: flex; flex-wrap: wrap; align-items: flex-start; gap: 20px; justify-content: space-between;">
                  
                  <div class="w3-col m3 w3-padding">
                    <p style="margin-top: 0;">
                      <strong style="color: #871521; font-size: 1.1em;">Kiroldegia:</strong>
                      <br />
                      <xsl:value-of select="Futbol_zelaia" />
                    </p>
                    <p style="line-height: 1.6;">
                      <xsl:value-of select="Informazioa" />
                    </p>
                  </div>

                  <div class="w3-col m8">
                    <h4 class="w3-border-bottom w3-padding-16" style="margin-top: 0; color: #333;">Jokalariak</h4>
                    <table class="w3-table w3-striped w3-bordered w3-hoverable">
                      <thead>
                        <tr style="background-color:#f1f1f1; color: #555;">
                          <th>Dortsala</th>
                          <th>Izena</th>
                          <th>Posizioa</th>
                        </tr>
                      </thead>
                      <tbody>
                        <xsl:for-each select="Jokalariak/Jokalari">
                          <xsl:sort select="@Dortsala" data-type="number" order="ascending"></xsl:sort>
                          <tr>
                            <td>
                              <xsl:value-of select="@Dortsala" />
                            </td>
                            <td><xsl:value-of select="Izena" />&#160;<xsl:value-of select="Abizena" /></td>
                            <td>
                              <xsl:value-of select="Posizioa" />
                            </td>
                          </tr>
                        </xsl:for-each>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
          </xsl:for-each>
          
        </xsl:otherwise>
      </xsl:choose>

    </div>
  </xsl:template>
</xsl:stylesheet>