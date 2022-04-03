<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : holidaylist.xsl
    Created on : 26 March 2022, 5:50 pm
    Author     : User
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:param name="beginIndex" tunnel="yes" as="xs:integer" select="0"/>
    <xsl:param name="endIndex" tunnel="yes" as="xs:integer" select="9999999"/>
    <xsl:param name="search" select="defaultstring"/>
    <xsl:param name="sortType" select="'dateStart'"/>
    <xsl:param name="sortOrder" select="'ascending'"/>
    <xsl:template match="holidays">
        <xsl:for-each select="holiday[contains(name, $search) 
        or contains(dateStart, $search) 
        or contains(dateEnd, $search)]">
            <xsl:sort select="*[name()=$sortType]" order="{$sortOrder}"/>
            <xsl:if test="position() &gt; $beginIndex and position() &lt; $endIndex">
               <tr>
                    <xsl:attribute name="id">
                        <xsl:value-of select="@id"/>
                    </xsl:attribute>
                    <td class='text-center'><xsl:value-of select="name"/></td>
                    <td class='text-center'>
                        <xsl:value-of select="dateStart"/>
                        <xsl:if test="dateStart != dateEnd ">
                             until <xsl:value-of select="dateEnd"/>
                        </xsl:if>
                        
                    </td>
                    <td class='text-center'>
                        <button class='btn btn-outline-warning'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("location.href=&apos;editholiday.php?id=",@id,"&apos;")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-pen-to-square"></i> Modify
                        </button>
                        <button class='btn btn-outline-danger'>
                            <xsl:attribute name="onclick">
                                <xsl:value-of select='concat("deleteDataRecord(&apos;",@id,"&apos;)")'/>
                            </xsl:attribute>
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                        
                    </td>
                </tr>
                
            </xsl:if>
            
           
        </xsl:for-each>

    </xsl:template>

</xsl:stylesheet>
