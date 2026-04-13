<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" />
    
    <xsl:param name="p_denboraldia" />

    <xsl:template match="/">
        <section class="w3-center w3-container" style="max-width: 1200px; margin: 0 auto; padding-bottom: 50px;">

            <div id="contenedor-jardunaldiak" style="width:100%; animation: fadeEffect 0.4s;">
                
                <xsl:for-each select="//Denboraldia[@urtea=$p_denboraldia]">
                    
                    <div id="temp-{@urtea}" class="tabla-temporada" style="width: 100%;">

                        <xsl:for-each select="Jardunaldiak/Jardunaldi">
                            <xsl:sort select="@zenbakia" data-type="number" order="ascending" />

                            <div style="margin-bottom: 50px;">
                                <div style="background-color: #871521; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 25px; text-align: left; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                    <h4 style="margin: 0; font-weight: bold; font-size: 1.2em; letter-spacing: 1px;">
                                        <xsl:value-of select="@zenbakia" />. JARDUNALDIA
                                    </h4>
                                </div>

                                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">

                                    <xsl:for-each select="Partidua">
                                        <xsl:variable name="etxekoG" select="number(Emaitza/@etxekoGolak)" />
                                        <xsl:variable name="kanpokoG" select="number(Emaitza/@kanpokoGolak)" />
                                        
                                        <div class="w3-card w3-round-large w3-white" style="width: 340px; overflow: hidden; transition: all 0.3s ease; border: 1px solid #f0f0f0;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 5px rgba(0,0,0,0.1)'">
                                            
                                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 25px 15px;">

                                                <div style="flex: 1; text-align: center;">
                                                    <img src="irudiak/eskutua/{EtxekoEzkutua}.png" alt="{EtxekoTaldea}" style="width: 55px; height: 55px; object-fit: contain; margin-bottom: 12px;" onerror="this.src='irudiak/eskutua/defecto.png'" />
                                                    <div style="font-size: 0.85em; font-weight: bold; color: #444; height: 35px; display: flex; align-items: center; justify-content: center; line-height: 1.2;">
                                                        <xsl:value-of select="EtxekoTaldea" />
                                                    </div>
                                                </div>

                                                <div style="padding: 0 15px; text-align: center;">
                                                    <xsl:choose>
                                                        <xsl:when test="Emaitza">
                                                            <div style="background-color: #f4f4f4; border-radius: 8px; padding: 10px 18px; font-size: 1.6em; font-weight: 900; color: #222; letter-spacing: 2px; border: 1px solid #e0e0e0;">
                                                                <xsl:value-of select="$etxekoG" />-<xsl:value-of select="$kanpokoG" />
                                                            </div>
                                                        </xsl:when>
                                                        <xsl:otherwise>
                                                            <div style="background-color: #fafafa; border: 2px dashed #ddd; border-radius: 8px; padding: 10px 18px; font-size: 1.2em; font-weight: bold; color: #aaa;">
                                                                VS
                                                            </div>
                                                        </xsl:otherwise>
                                                    </xsl:choose>
                                                </div>

                                                <div style="flex: 1; text-align: center;">
                                                    <img src="irudiak/eskutua/{KanpokoEzkutua}.png" alt="{KanpokoTaldea}" style="width: 55px; height: 55px; object-fit: contain; margin-bottom: 12px;" onerror="this.src='irudiak/eskutua/defecto.png'" />
                                                    <div style="font-size: 0.85em; font-weight: bold; color: #444; height: 35px; display: flex; align-items: center; justify-content: center; line-height: 1.2;">
                                                        <xsl:value-of select="KanpokoTaldea" />
                                                    </div>
                                                </div>

                                            </div>
                                            
                                            <xsl:if test="Emaitza">
                                                <div style="height: 4px; width: 100%; background-color: #871521; opacity: 0.9;"></div>
                                            </xsl:if>
                                            
                                        </div>
                                    </xsl:for-each>
                                </div>
                            </div>
                        </xsl:for-each>
                    </div>
                </xsl:for-each>
            </div>

        </section>
    </xsl:template>
</xsl:stylesheet>