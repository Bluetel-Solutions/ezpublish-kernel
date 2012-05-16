<?php
/**
 * File containing the Object State Handler interface
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace eZ\Publish\SPI\Persistence\Content\ObjectState;

use eZ\Publish\SPI\Persistence\Content\ObjectState\InputStruct;
/**
 * The Object State Handler interface provides managing of object states and groups
 *
 */
interface Handler
{
    /**
     * creates a new object state group
     *
     * @param \ez\Publish\SPI\Persistence\Content\ObjectState\InputStruct $input
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState\Group
     */
    public function createGroup( InputStruct $input);

    /**
     * Loads a object state group
     *
     * @param $groupId
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\NotFoundException if the group was not found
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState\Group
     */
    public function loadGroup( $groupId);

    /**
     * Loads all object state groups
     *
     * @param int $offset
     * @param int $limit
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState\Group[]
     */
    public function loadAllGroups($offset = 0, $limit = -1);

    /**
     * This method returns the ordered list of object states of a group
     *
     * @param mixed $groupId
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState[]
     */
    public function loadObjectStates($groupId);


    /**
     * updates an object state group
     *
     * @param mixed $groupId
     * @param \ez\Publish\SPI\Persistence\Content\ObjectState\InputStruct $input
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState\Group
     */
    public function updateGroup( $groupId, InputStruct $input);

    /**
     * Deletes a object state group including all states and links to content
     *
     * @param mixed $groupId
     */
    public function deleteGroup( $groupId);

    /**
     * creates a new object state in the given group.
     * The new state gets the last priority.
     * Note: in current kernel: If it is the first state all content objects will
     * set to this state.
     *
     * @param mixed $groupId
     * @param \ez\Publish\SPI\Persistence\Content\ObjectState\InputStruct $input
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState
     */
    public function create( $groupId, InputStruct $input);

    /**
     * Loads an object state
     *
     * @param $stateId
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\NotFoundException if the state was not found
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState
     */
    public function load( $stateId);

    /**
     * updates an object state
     *
     * @param mixed $stateId
     * @param \ez\Publish\SPI\Persistence\Content\ObjectState\InputStruct $input
     *
     * @return \ez\Publish\SPI\Persistence\Content\ObjectState
     */
    public function update($stateId, InputStruct $input);

    /**
     * changes the priority of the state
     *
     * @param mixed $stateId
     * @param int $priority
     */
    public function setPriority( $stateId, $priority);

    /**
     * Deletes a object state. The state of the content objects is reset to the
     * first object state in the group.
     *
     * @param mixed $stateId
     */
    public function delete($stateId);


    /**
     * Sets the object-state of a state group to $state for the given content.
     *
     * @param mixed $contentId
     * @param mixed $groupId
     * @param mixed $stateId
     * @return boolean
     */
    public function setObjectState( $contentId, $groupId, $stateId );

    /**
     * Gets the object-state of object identified by $contentId.
     *
     * The $state is the id of the state within one group.
     *
     * @param mixed $contentId
     * @param mixed $stateGroupId
     * @return mixed
     */
    public function getObjectState( $contentId, $stateGroupId );

    /**
     * returns the number of objects which are in this state
     *
     * @param $state
     */
    public function getContentCount( $state );

}